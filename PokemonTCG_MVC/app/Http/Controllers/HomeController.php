<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card; 


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $cardsAmount = Card::where('id', auth()->user()->id)->count();
        return view('home', compact('cardsAmount'));
    }
}
