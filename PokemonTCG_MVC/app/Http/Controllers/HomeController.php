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
     * Display the home page with user's card information.
     *
     * @return \Illuminate\View\View 
     * Returns the view for displaying the home page.
     */
    public function index()
    {
        // Get the count of cards belonging to the current authenticated user
        $cardsAmount = Card::where('user_id', auth()->user()->id)->count();

        // Initialize $latestCardImage to null
        $latestCardImage = null;

        // Check if the user has any cards
        if ($cardsAmount > 0) {
            // Get the latest card image of the current authenticated user
            $latestCardImage = Card::where('user_id', auth()->user()->id)->latest()->first()->image;
        }

        // Pass the card count and the latest card image to the view
        return view('home', compact('cardsAmount', 'latestCardImage'));
    }

}