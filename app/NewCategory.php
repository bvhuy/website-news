<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewCategory extends Model
{
    public $timestamps = false;
    protected $fillable = ['new_id', 'category_id', 'type_id'];
    //protected $primaryKey = 'id';
    protected $table = 'tbl_new_category';
}
