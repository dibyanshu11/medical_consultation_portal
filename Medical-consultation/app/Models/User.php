<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserRole;
use App\Enums\StatusEnum;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'email',
        'mobile',
        'image',
        'role',
        'status',
        'device_type',
        'device_token',
        'otp',
        'otp_verified',
        'password',
        'remember_token',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'role' => UserRole::class,
        // 'status' => StatusEnum::class
    ];

    public function getImageAttribute($value)
    {

        return env('APP_URL') . '/storage/user-profile/' . $value;
    }


    public function office()
    {
        return $this->hasMany(Office::class, 'user_id', 'id');
    }
}
