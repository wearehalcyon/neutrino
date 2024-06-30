<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'author_id',
        'status',
        'content',
        'delayed_date',
        'thumbnail',
        'thumbnail_file'
    ];

    public function getAuthor()
    {
        return User::where('id', $this->author_id)->first();
    }

    public function getCategoriesIds()
    {
        $categories = PostToCategory::where('post_id', $this->id)->get();

        $ids = [];
        foreach ($categories as $category) {
            $ids[] =  $category->category_id;
        }

        return $ids;
    }

    public function getPostMeta($meta_key)
    {
        $value = PostMeta::where([
            'post_id' => $this->id,
            'meta_key' => $meta_key
        ])->first();

        return $value->meta_value;
    }
}
