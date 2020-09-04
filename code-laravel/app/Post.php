<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected array $fillable = [
        'slug',
        'title',
        'summary',
        'body',
        'user_id',
    ];
}
