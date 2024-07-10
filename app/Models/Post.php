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

    public function type()
    {
        return 'post';
    }

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
        $value = ContentMeta::where([
            'post_id' => $this->id,
            'meta_key' => $meta_key
        ])->first();

        if ($value) {
            return $value->meta_value;
        }

        return '';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_to_categories', 'post_id', 'category_id');
    }
}
