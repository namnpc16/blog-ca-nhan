<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'status'];

    public function setFirstNameAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function posts()
    {
        return $this->belongsToMany(Posts::class, 'posts_categories', 'category_id', 'post_id');
    }
}
