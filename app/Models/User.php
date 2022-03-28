<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'last_name',
        'first_name',
        'role_id',
        'api_token',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected static $filterable = [
        'id'            => 'integer',
        'name'          => 'max:255',
        'email'         => 'email',
        'last_name'     => 'max:255',
        'first_name'    => 'max:255',
        'role_id'       => 'integer',
        'status'        => 'in:enable,disable',

        '_orderby'      => 'in:id,name,email,last_name,first_name,created_at,updated_at',
        '_sort'         => 'in:asc,desc',
        '_keyword'      => 'max:255',
        '_limit'        => 'integer',
        '_offset'       => 'integer'
    ];

    protected static $defaultFilter = [
        'status'        => 'enable',
        '_orderby'      => 'updated_at',
        '_sort'         => 'desc'
    ];

    protected static $defaultStatus = 'enable';


    public function isAdmin()
    {
        return $this->role->type === '*';
    }

    public function role()
    {
        return $this->beLongsTo(Role::class);
    }

    public function scopeApplyFilter($query, $args = [])
    {
        $args = array_merge(self::$defaultFilter, $args);

        $query->baseFilter($args);

        // foreach ($args as $key => $value) {
        //     if ($key == 'status') {
        //         switch ($value) {
        //             case 'enable':
        //                 $query->enable();
        //                 break;

        //             case 'disable':
        //                 $query->disable();
        //                 break;
        //         }
        //     } elseif (!in_array($key, ['_orderby', '_sort', '_limit', '_offset', '_keyword'])) {
        //         $query->where($key, $value);
        //     }
        // }
    }

    public function isSelf()
    {
        if (!\Auth::check()) {
            return false;
        }

        return \Auth::user()->id == $this->id;
    }



    public static function getRequestFilter($defaultFilter = [])
    {
        $filter = array_merge(self::$defaultFilter, $defaultFilter, Input::all());

        $validator = Validator::make($filter, self::$filterable);

        $fieldErros = [];
        if ($validator->fails()) {
            $fieldErros = array_keys($validator->errors()->toArray());
        }

        foreach ($filter as $field => $value) {
            if (!isset(self::$filterable[$field]) || in_array($field, $fieldErros) && !isset(self::$defaultFilter[$field])) {
                unset($filter[$field]);
            } elseif (in_array($field, $fieldErros) && isset(self::$defaultFilter[$field])) {
                $filter[$field] = self::$defaultFilter[$field];
            }
        }

        return array_map('trim', $filter);
    }

    public function scopeBaseFilter($query, $args = [])
    {
        if (isset($args[$this->primaryKey])) {
            $query->where($this->table . '.' . $this->primaryKey, $args[$this->primaryKey]);
        }

        if (!empty($args['_orderby']) && !empty($args['_sort'])) {
            $query->orderBy($args['_orderby'], $args['_sort']);
        }

        if (!empty($args['_limit'])) {
            $query->limit($args['_limit']);
        }

        if (!empty($args['_offset'])) {
            $query->offset($args['_offset']);
        }

        if (!empty($args['_keyword']) && property_exists($this, 'searchable')) {
            $query->search($args['_keyword']);
        }
    }

    public function scopeEnable($query)
    {
        return $query->where('status', '1');
    }

    public function scopeDisable($query)
    {
        return $query->where('status', '0');
    }

    public function markAsEnable()
    {
        $this->where('id', $this->id)->update(['status' => '1']);
    }

    public function markAsDisable()
    {
        $this->where('id', $this->id)->update(['status' => '0']);
    }

    public function setStatusAttribute($value)
    {
        switch ($value) {
            case 'disable':
                $this->attributes['status'] = '0';
                break;

            case 'enable':
                $this->attributes['status'] = '1';
                break;
        }
    }

    public function getStatusSlugAttribute()
    {
        if (!is_null($this->status)) {
            return $this->statusable()->all()[$this->status]['slug'];
        }

        return $this->getDefaultStatus();
    }

    public function getStatusNameAttribute()
    {
        return $this->statusable()->all()[$this->status]['name'];
    }

    public static function statusable()
    {
        return new Collection([
            ['id' => '0', 'name' => 'Tắt', 'slug' => 'disable'],
            ['id' => '1', 'name' => 'Bật', 'slug' => 'enable'],
        ]);
    }

    public static function getDefaultStatus()
    {
        return 'disable';
    }

    public function getHtmlClassAttribute()
    {
        if ($this->status == '0') {
            return 'bg-danger';
        }
        return null;
    }

    public function isEnable()
    {
        return $this->status == 1;
    }

    public function isDisable()
    {
        return $this->status == 0;
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }
}
