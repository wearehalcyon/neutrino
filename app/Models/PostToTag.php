<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostToTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'tag_id',
    ];

    public $timestamps = false;
}
