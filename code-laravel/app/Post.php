<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'summary',
        'body',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    static public function findBySlug($slug)
    {
        return self::query()->where('slug', '=', $slug)->first();
    }
}
