<?php

namespace App\Modules\posts_metrics\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PostsMetric extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'post_id',
        'group_type',
        'views',
        'likes',
        'comments',
        'reposts',
    ];
}
