<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static array $roles = ['admin', 'moderator', 'user'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'password',
        'about',
    ];

    protected $attributes = [
        'role' => 'user'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['role'] === 'admin',
        );
    }

    protected function isModerator(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['role'] === 'moderator',
        );
    }
}
