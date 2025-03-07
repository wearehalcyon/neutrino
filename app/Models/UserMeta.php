<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firs_tname',
        'last_name',
        'display_name',
        'description',
        'birth_date',
    ];
}
