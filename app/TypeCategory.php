<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCategory extends Model
{
    public $timestamps = false;
    protected $fillable = ['type_id', 'category_id'];
    //protected $primaryKey = 'id';
    protected $table = 'tbl_type_category';
}
