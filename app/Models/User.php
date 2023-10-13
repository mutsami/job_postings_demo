<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'provider',
        'provider_id',
        'provider_token',
        'avatar'
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
        'password' => 'hashed',
    ];

    public static function generateUsername($username){
        if ($username === null) {
            $username = Str::lower(Str::random(strlen(8))); // Use `strlen` instead of `length`
        }
    
        if (User::where('username', $username)->exists()) {
            $newusername = $username.Str::lower(Str::random(strlen(3))); // Use `strlen` here as well
    
            $username = self::generateUsername($newusername);
        }
    
        return $username; // Make sure to return the final username
    }
    
}
