<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'code', 'status', 'created_by', 'modified_by'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_category';

    public function tbl_new()
    {
        return $this->belongsToMany(News::class, 'tbl_new_category', 'new_id', 'category_id');
    }

    public function tbl_type()
    {
        return $this->belongsToMany(Type::class, 'tbl_type_category', 'type_id', 'category_id');
    }
}
