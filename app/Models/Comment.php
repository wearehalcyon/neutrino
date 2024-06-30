<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'author_id',
        'comment',
        'status',
    ];

    public function getAuthor()
    {
        $author = User::find($this->author_id);
        return $author;
    }
}
