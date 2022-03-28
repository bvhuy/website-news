<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsToCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news_to_categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'news_id',
        'category_id',
    ];
}
