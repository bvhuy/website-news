<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videos';

    protected $primaryKey = 'id';

    protected $slugSource = 'title';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'url',
        'filename',
        'thumbnail',
        'content',
        'description',
        'author_id',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    /**
     * Các tham số được phép truyền vào từ URL
     *
     * @var array
     */
    protected static $filterable = [
        'id' => '',
        'title' => '',
        'status' => 'in:pending,enable,disable',
        'time_status' => 'in:coming,enable,disable',
        'category_video_id' => 'integer',
    ];

    /**
     * Giá trị mặc định của các tham số
     *
     * @var array
     */
    protected static $defaultFilter = [
        'status'            => 'enable',
        '_orderby'          => 'updated_at',
        '_sort'             => 'desc',
    ];

    protected $searchable = ['id', 'title'];

    public function categories()
    {
        return $this->beLongsToMany(CategoryVideo::class, 'video_to_categories');
    }

    // public function category()
    // {
    //     return $this->belongsToMany(Category::class, 'video_to_categories', 'news_id', 'category_id');
    // }

    public function author()
    {
        return $this->beLongsTo(User::class);
    }

    public function scopeApplyFilter($query, $args = [])
    {
        $args = array_merge(self::$defaultFilter, $args);
        $query->baseFilter($args);

        // if (!empty($args['status'])) {
        //     switch ($args['status']) {
        //         case 'enable':
        //             $query->enable();
        //             break;

        //         case 'disable':
        //             $query->disable();
        //             break;
        //     }
        // }

        if (!empty($args['author_id'])) {
            $query->where('author_id', $args['author_id']);
        }

        if (!empty($args['title'])) {
            $query->where('title', $args['title']);
        }

        if (!empty($args['category_video_id'])) {
            $query->join('video_to_categories', 'videos.id', '=', 'video_to_categories.video_id');
            $query->where('video_to_categories.category_video_id', $args['category_video_id']);
        }
    }

    public function getSubContentAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        if (!empty($this->content)) {
            return Str::limit(strip_tags($this->content), 150);
        }

        return null;
    }

    // public function getThumbnailAttribute($value)
    // {
    //     if (!empty($value)) {
    //         return $value;
    //     }

    //     return setting('default-thumbnail', upload_url('no-thumbnail.png'));
    // }

    // public function hasThumbnail()
    // {
    //     return !empty($this->thumbnail) && $this->thumbnail !== setting('default-thumbnail', upload_url('no-thumbnail.png'));
    // }

    public function setAuthorIdAttribute($value)
    {
        if (User::where('id', $value)->exists()) {
            $this->attributes['author_id'] = $value;
        } else {
            $this->attributes['author_id'] = User::first()->id;
        }
    }

    protected static $defaultStatus = 'enable';

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

    // public static function statusable()
    // {
    //     return new Collection([
    //         ['id' => '0', 'name' => trans('cms.disable'), 'slug' => 'disable'],
    //         ['id' => '1', 'name' => trans('cms.enable'), 'slug' => 'enable'],
    //     ]);
    // }

    public static function getDefaultStatus()
    {
        return 'enable';
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


    public function setSlugAttribute($value)
    {
        if (property_exists($this, 'slugSource')) {
            $slug = $this->slugSource;
        } else {
            $slug = 'title';
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
