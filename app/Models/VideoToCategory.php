<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoToCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'video_to_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'video_id',
        'category_video_id',
    ];
}
