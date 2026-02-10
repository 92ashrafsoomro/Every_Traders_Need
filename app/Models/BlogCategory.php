<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $fillable = ['title','type'];
    

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function scopeBlog($query)
    {
        return $query->where('type', 'blog');
    }

    public function scopeNews($query)
    {
        return $query->where('type', 'news');
    }
}
