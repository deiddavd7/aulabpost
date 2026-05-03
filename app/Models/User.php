<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_revisor',
        'is_writer',
        'admin_request',
        'revisor_request',
        'writer_request',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'is_revisor' => 'boolean',
            'is_writer' => 'boolean',
            'admin_request' => 'boolean',
            'revisor_request' => 'boolean',
            'writer_request' => 'boolean',
        ];
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}

  