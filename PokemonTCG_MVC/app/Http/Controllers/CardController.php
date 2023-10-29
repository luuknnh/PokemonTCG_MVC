<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card; 
use Pokemon\Pokemon;
use stdClass;




class CardController extends Controller
{

/**
 * Display a listing of the user's cards.
 *
 * @return \Illuminate\View\View 
 * Returns the view containing the user's cards.
 */
public function index()
{
    // Get all the cards belonging to the current authenticated user
    $cards = Card::where('user_id', auth()->user()->id)->get();

    return view('cards.index', compact('cards'));
}

/**
 * Show the form for creating a new card.
 *
 * @return \Illuminate\View\View 
 * Returns the view for creating a new card with the available sets.
 */
public function create()
{
    // Fetch all available sets for creating a new card
    $sets = Pokemon::Set()->all();
    
    return view('cards.create', compact('sets'));
}

/**
 * Store a newly created card in the database.
 *
 * @param  \Illuminate\Http\Request  
 * $request The HTTP request containing the card data.
 * @return string 
 * Returns a message indicating that the card has been successfully added.
 */
public function store(Request $request)
{
    // Validate the incoming request data for creating a new card
    $data = $request->validate([
        'name' => 'required',
        'type' => 'required',
        'rarity' => 'required',
        'image' => 'required|url', 
    ]);

    // Create a new card associated with the current authenticated user
    auth()->user()->cards()->create([
        'name' => $data['name'],
        'type' => $data['type'],
        'rarity' => $data['rarity'],
        'image' => $data['image'], 
    ]);

    return "Card has been added.";
}

/**
 * Search for cards based on set ID and card name.
 *
 * @param \Illuminate\Http\Request 
 * $request The HTTP request containing the search parameters.
 * @return \Illuminate\Http\JsonResponse 
 * Returns a JSON response containing the search results.
 */
public function searchCard(Request $request)
{
    $setId = $request->input('setId');
    $cardName = $request->input('cardName');

if ($setId === 'All') {
    if ($cardName) {
        $cards = Pokemon::Card()->where(['name' => $cardName . '*'])->all();
    } else {
        $cards = Pokemon::Card()->all();
    }
} else {
    if ($cardName) {
        $cards = Pokemon::Card()->where(['set.id' => $setId, 'name' => $cardName])->all();
    } else {
        $cards = Pokemon::Card()->where(['set.id' => $setId])->all();
    }
}
       $formattedData = [];
    foreach ($cards as $card) {
        $formattedData[] = $card->toArray();
    }

    return response()->json($formattedData);

}


/**
 * Display the specified card.
 *
 * @param int $id The ID of the card to display.
 * @return \Illuminate\View\View Returns the view for displaying the specified card.
 */
public function show($id)
{
    // Find the card that matches the provided ID
    $card = Card::find($id);
    return view('cards.show', compact('card'));
}


}