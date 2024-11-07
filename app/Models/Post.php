<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'categories_id',
        'title',
        'slug',
        'photo',
        'content',
    ];
}
