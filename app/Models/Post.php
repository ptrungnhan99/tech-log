<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'description',
        'content',
        'thumbnail',
        'view_counts',
        'user_id',
        'category_id',
        'slug',
        'highlight',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
    public function next()
    {
        // get next post
        return Post::where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }
    public  function previous()
    {
        // get previous post
        return Post::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }
}
