<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFormDatabase extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'form_name',
        'form_unique_id',
        'form_data',
        'user_ip',
        'user_agent',
    ];
}
