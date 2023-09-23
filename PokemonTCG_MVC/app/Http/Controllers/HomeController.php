<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $users = [
            '0' => [
                'first_name' => 'Renato',
                'last_name' => 'Santos',
                'location' => 'Brazil'
            ],
            '1' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'location' => 'USA'
            ]
        ];

        return view('home', compact('users'));
    }
}
