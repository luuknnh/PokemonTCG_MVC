<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'User';
    protected $fillable = [
        'username', 'emailaddress', 'userpassword', 'role', 'created_at',
    ];

    protected $primaryKey = 'userid';

    public $timestamps = true; 
   
}
