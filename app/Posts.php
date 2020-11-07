<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = 'post';

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'posts_categories', 'post_id', 'category_id');
    }
}
