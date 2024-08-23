<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    const ADMIN=1;
    const STAFF=2;
    const CUSTOMAR=3;
    const SUPPLIER=4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded =  ['id'];

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


   public function scopeCustomar($query){
        return $query->where('role_id',User::CUSTOMAR);
    }

   public function scopeSupplier($query){
        return $query->where('role_id',User::SUPPLIER);
    }

   public function scopeAdmin($query){
        return $query->where('role_id',User::ADMIN);
    }

   public function scopeStaff($query){
        return $query->where('role_id',User::STAFF);
    }
}
