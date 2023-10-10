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

public function show($id)
{
    $user = User::find($id); 

    return view('user', compact('user')); 
}

public function delete($id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('users.index')->with('error', 'Gebruiker niet gevonden');
    }

    $user->delete();

    return redirect()->route('users.index')->with('success', 'Gebruiker succesvol verwijderd');
}
}
