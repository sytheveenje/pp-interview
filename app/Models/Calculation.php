<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = ['input', 'result'];

    protected $casts = [
        'result' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
