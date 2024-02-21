<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const ROLE_SELLER = 'seller';
    const ROLE_CLIENT = 'client';

    protected $fillable = [
        'name', 'email', 'password', 'role','profile_image','hourly_rate','self_introduction', 'fcm_token',
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
   
 // User model
public function skills()
{
    return $this->belongsToMany(Skill::class);
}


    public function portfolio()
    {
        return $this->hasMany(Portfolio::class);
    }





   
  
}

