<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'author_id',
        'status',
        'content',
        'template'
    ];

    public function type()
    {
        return 'page';
    }

    public function getAuthor()
    {
        return User::where('id', $this->author_id)->first();
    }

    public function getPageMeta($meta_key)
    {
        $value = PageMeta::where([
            'page_id' => $this->id,
            'meta_key' => $meta_key
        ])->first();

        if ($value) {
            return $value->meta_value;
        }

        return '';
    }
}
