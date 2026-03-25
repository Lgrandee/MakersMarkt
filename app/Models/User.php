<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))

    /**
     * Get the products (as a maker) created by this user.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'user_id');
    }

    /**
     * Get the orders (as a buyer) made by this user.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    /**
     * Get the reviews written by this user.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    /**
     * Get the notifications for this user.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    /**
     * Get the reports filed by this user.
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class, 'user_id');
    }
            ->implode('');
    }
}
