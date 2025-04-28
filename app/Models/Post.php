<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'author', 'is_draft', 'published_at'];

    protected $casts = [
        'is_draft' => 'boolean',
        'published_at' => 'datetime',
    ];
}
