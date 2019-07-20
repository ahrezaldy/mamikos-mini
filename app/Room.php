<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'city', 'price', 'availability'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
