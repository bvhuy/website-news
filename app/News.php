<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'code', 'thumbnail', 'shortdescription', 'content', 'status', 'created_by', 'modified_by', 'view_count'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_new';

    public function tbl_category()
    {
        return $this->belongsToMany(Category::class, 'tbl_new_category', 'new_id', 'category_id');
    }
}
