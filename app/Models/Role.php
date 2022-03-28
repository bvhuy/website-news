<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'type',
    ];

    protected static $filterable = [
        'id'            => 'integer',
        'name'          => 'max:255',
        '_orderby'      => 'in:id,name,created_at,updated_at',
        '_sort'         => 'in:asc,desc',
        '_keyword'      => 'max:255',
        '_limit'        => 'integer',
        '_offset'       => 'integer',
    ];

    protected static $defaultFilter = [
        '_orderby'      => 'updated_at',
        '_sort'         => 'desc',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function scopeApplyFilter($query, $args = [])
    {
        $args = array_merge(self::$defaultFilter, $args);
        $query->baseFilter($args);
    }

    public function isFull()
    {
        return $this->type == '*';
    }

    public function isEmpty()
    {
        return $this->type == '0';
    }

    public function isOption()
    {
        return $this->type == 'option';
    }

    public function isAdmin()
    {
        if ($this->isEmpty()) {
            return false;
        }

        return true;
    }

    public static function typeable()
    {
        return new Collection([
            // ['id' => '*', 'name' => 'Có mọi quyền'],
            ['id' => '0', 'name' => 'Cấm tất cả'],
            ['id' => 'option', 'name' => 'Tùy chọn'],
        ]);
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
}
