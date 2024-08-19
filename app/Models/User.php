<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'name',
        'username',
        'last_active_at',
        'email',
        'password',
    ];

    public function activeStatus() {
        $timezone = 'Asia/Dhaka';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->last_active_at, $timezone);
        $now = Carbon::now($timezone);
    
        if ($date->greaterThanOrEqualTo($now->subMinutes(5))) {
            return 'Active now';
        }
    
        return $date->diffForHumans();
    }
    


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
}