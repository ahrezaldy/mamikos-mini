<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public const ADMIN_ROLE = 1;
    public const REGULAR_USER_ROLE = 2;
    public const PREMIUM_USER_ROLE = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'type', 'credits'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
