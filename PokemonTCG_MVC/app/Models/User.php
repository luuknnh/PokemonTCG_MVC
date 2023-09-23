<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'Username', 'EmailAddress', 'UserPassword', 'CreatedOn', 'Role',
    ];

    protected $primaryKey = 'UserId';

    public $timestamps = false; // Zorgt ervoor dat de timestamps niet worden ingevuld


}
