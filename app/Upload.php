<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'uuid',
        'key',
        'bucket',
        'name',
        'content_type',
        'user_id'
    ];

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
