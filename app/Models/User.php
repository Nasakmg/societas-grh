<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
        ];
    }

    // Rôles
    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isManager(): bool  { return $this->role === 'manager'; }
    public function isEmploye(): bool  { return $this->role === 'employe'; }
    public function isComptable(): bool{ return $this->role === 'comptable'; }

    // Relations
    public function employe()
    {
        return $this->hasOne(Employe::class);
    }
}
