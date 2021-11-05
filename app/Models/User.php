<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'thumbnail',
        'is_active',
        'account_type',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => "datetime:Y-m-d",
    ];

    public function scopeAdmin($query)
    {
        return $query->where('account_type', '=', 'ADMIN');
    }

    public function scopeClient($query)
    {
        return $query->where('account_type', '=', 'CLIENT');
    }
}
