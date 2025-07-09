<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'balance',
        'total_deposit',
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
    ];
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    public function depoisite()
    {
        return $this->hasMany(Deposite::class);
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
    public function tasks()
    {
        return $this->hasMany(OrderTask::class);
    }
}
