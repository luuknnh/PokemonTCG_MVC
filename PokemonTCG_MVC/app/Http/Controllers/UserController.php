<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Haal alle gebruikers op uit de database

        return view('users', compact('users')); // Stuur de gebruikersgegevens naar de weergave
    }
}
