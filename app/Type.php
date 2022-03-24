<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'code',
        'status',
        'created_by',
        'modified_by',
        'shortdescription',
        'keywords',
        'position_number',
        'status_position'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_type';

    public function tbl_category()
    {
        return $this->belongsToMany(Category::class, 'tbl_type_category', 'type_id', 'category_id');
    }
}
