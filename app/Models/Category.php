<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'author_id',
    ];

    public function getAuthor()
    {
        return User::where('id', $this->author_id)->first();
    }

    public function getPosts()
    {
        $posts = PostToCategory::join('posts', 'post_to_categories.post_id', '=', 'posts.id')
            ->where('post_to_categories.category_id', $this->id)
            ->select(
                'posts.*',
                'posts.id as id'
            )
            ->get();

        return $posts;
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_to_categories', 'category_id', 'post_id');
    }
}
