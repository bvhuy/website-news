<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory, SoftDeletes, NodeTrait;

    protected $table = 'menus';

    protected $primaryKey = 'id';

    protected $slugSource = 'name';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'status'
    ];

    // public function getLftName()
    // {
    //     return 'left';
    // }

    // public function getRgtName()
    // {
    //     return 'right';
    // }

    // public function getParentIdName()
    // {
    //     return 'parent';
    // }

    // // Specify parent id attribute mutator
    // public function setParentAttribute($value)
    // {
    //     $this->setParentIdAttribute($value);
    // }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    protected static $filterable = [
        'id'  => 'integer',
        'name' => 'max:255',

        '_orderby'      => 'in:id,name,created_at,updated_at',
        '_sort'         => 'in:asc,desc',
        '_keyword'      => 'max:255',
        '_limit'        => 'integer',
        '_offset'       => 'integer',
    ];

    protected static $defaultFilter = [
        '_orderby'          => 'updated_at',
        '_sort'             => 'desc',
    ];


    protected $searchable = ['id', 'name', 'meta_keyword'];

    public function scopeApplyFilter($query, $args = [])
    {
        $args = array_merge(self::$defaultFilter, $args);
        $query->baseFilter($args);
    }

    public function getMenuTitleAttribute()
    {
        return $this->name;
    }

    public function setSlugAttribute($value)
    {
        if (property_exists($this, 'slugSource')) {
            $slug = $this->slugSource;
        } else {
            $slug = 'name';
        }

        if ($value) {
            // $this->attributes['slug'] = $value;
            $this->attributes['slug'] = Str::slug($value);
        } else {
            $this->attributes['slug'] = Str::slug($this->$slug);
        }
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

    public function scopeParentAble($query)
    {
        $query->where('id', '!=', $this->id)->where('parent_id', '!=', $this->id)->orWhere('parent_id', null);
    }

    public function isEnable()
    {
        return $this->status == 1;
    }

    public function isDisable()
    {
        return $this->status == 0;
    }

    public function markAsEnable()
    {
        $this->where('id', $this->id)->update(['status' => '1']);
    }

    public function markAsDisable()
    {
        $this->where('id', $this->id)->update(['status' => '0']);
    }
}
