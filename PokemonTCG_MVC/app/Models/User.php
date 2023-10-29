<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', "role"
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the cards associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     * Returns the relationship between the user and its cards.
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }


    /**
     * Get the collections associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     * Returns the relationship between the user and its collections.
     */
    public function collections()
    {
        return $this->hasMany(Collection::class, 'userid', 'id');
    }

}