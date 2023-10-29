<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 

        return view('users.index', compact('users')); 
    }

public function show($id)
{
    $user = User::find($id); 

    return view('users.show', compact('user')); 
}

public function delete($id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect()->route('users.index')->with('error', 'Gebruiker niet gevonden');
    }

    foreach ($user->collections as $collection) {
        $collection->delete();
    }

    $user->delete();

    return redirect()->route('users.index')->with('success', 'Gebruiker succesvol verwijderd');
}



}