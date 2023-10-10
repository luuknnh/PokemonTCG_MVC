<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 

        return view('users', compact('users')); 
    }

    public function create()
{
    return view('create_user');
}

public function store(Request $request)
{
    // Valideer en sla de nieuwe gebruiker op in de database
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ]);

    User::create($data); // Creëer een nieuwe gebruiker in de database

    return redirect('/users'); // Stuur de gebruiker terug naar de lijst met gebruikers
}
}
