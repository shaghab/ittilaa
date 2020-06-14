<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    //The table associated with the model.
    protected $table = 'x_users';

    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 
        'email', 
        'category', 
        'password',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
