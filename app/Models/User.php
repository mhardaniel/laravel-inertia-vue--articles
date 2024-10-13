<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'firstname',
        'lastname',
        'type',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => ucfirst($this->firstname).' '.ucfirst($this->lastname),
        );
    }

    protected $appends = ['full_name'];

    public function articlesWriter(): HasMany
    {
        return $this->hasMany(Article::class, 'writer');
    }

    public function articlesEditor(): HasMany
    {
        return $this->hasMany(Article::class, 'editor');
    }
}
