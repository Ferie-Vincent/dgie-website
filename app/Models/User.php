<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use \App\Traits\Auditable;

    protected $fillable = ['name', 'email', 'password', 'role', 'avatar', 'last_login_at', 'must_change_password', 'pending_email', 'email_verification_token'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'must_change_password' => 'boolean',
        ];
    }

    public function isSuperAdmin(): bool { return $this->role === 'super-admin'; }
    public function isEditeur(): bool { return $this->role === 'editeur'; }
    public function isRedacteur(): bool { return $this->role === 'redacteur'; }

    public function getRoleLabel(): string
    {
        return match ($this->role) {
            'super-admin' => 'Super Admin',
            'editeur' => 'Éditeur',
            'redacteur' => 'Rédacteur',
            default => ucfirst($this->role),
        };
    }

    public function articles() { return $this->hasMany(Article::class, 'author_id'); }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : null;
    }

    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', trim($this->name));
        return count($parts) >= 2
            ? strtoupper(mb_substr($parts[0], 0, 1) . mb_substr($parts[1], 0, 1))
            : strtoupper(mb_substr($this->name, 0, 2));
    }
}
