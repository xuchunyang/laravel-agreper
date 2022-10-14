<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'registration_enabled',
    ];

    protected $casts = [
        'registration_enabled' => 'boolean',
    ];
}
