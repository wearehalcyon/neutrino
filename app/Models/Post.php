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
    ];

    public function getAuthor()
    {
        return User::where('id', $this->author_id)->first();
    }
}
