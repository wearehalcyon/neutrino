<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'post_id',
        'category_id',
        'tag_id',
        'type',
        'meta_key',
        'meta_value',
    ];
}
