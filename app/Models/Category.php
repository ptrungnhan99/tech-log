<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
        'cat_order'
    ];
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
