<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str; // This should be correctly imported


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'usertype',
        'refresh_token', // Ensure this is added here
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'refresh_token', // Consider hiding this for security
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Define the relationship with the Booking model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Blog::class, 'likes')->withTimestamps();
    }

    /**
     * Generate a new refresh token for the user.
     *
     * @return string
     */
    public function generateRefreshToken()
    {
        $this->refresh_token = Str::random(60); // Generate a random refresh token
        $this->save();
    
        return $this->refresh_token;
    }
    
    /**
     * Revoke the user's refresh token.
     *
     * @return void
     */
    public function revokeRefreshToken()
    {
        $this->refresh_token = null; // Revoke the refresh token
        $this->save();
    }

    public function routeNotificationForMail($notification)
{
    return $this->email; // This specifies to use the user's email for mail notifications.
}
}
