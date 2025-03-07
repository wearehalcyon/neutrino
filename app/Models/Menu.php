<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'author_id',
    ];

    public function getAuthor()
    {
        return User::where('id', $this->author_id)->first();
    }
}
