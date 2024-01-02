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

    protected $fillable = [
        'name',
        'email',
        'password',
        'skill',
        'country',
        'district',
        'number',
        'interested_in',
        'startup_state',
        'successful_startups',
        'startup_names',
        'startup_funded',
        'mostly_interected_with',
        'intereted_with',
        'type_of_people_interected_with',
        'others',
        'package'
    ];
    protected $casts = [
        'interested_in' => 'json',
        'startup_state' => 'json',
        'successful_startups' => 'json',
        'startup_names' => 'json',
        'startup_funded' => 'json',
        'mostly_interected_with' => 'json',
        'type_of_people_interected_with' => 'json',
        'others' => 'json',
        'email_verified_at' => 'datetime',
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
    public function interestedWith()
    {
        return $this->belongsTo(User::class, 'intereted_with');
    }
    public function transactions()
    {
        return $this->hasMany(UserTransaction::class, 'user_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
