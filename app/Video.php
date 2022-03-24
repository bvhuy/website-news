<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'code',
        'status',
        'created_by',
        'modified_by',
        'created_at', 
        'updated_at'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_video';
}
