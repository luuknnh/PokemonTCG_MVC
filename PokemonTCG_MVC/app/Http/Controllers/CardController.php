<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card; 
use Pokemon\Pokemon;
use stdClass;




class CardController extends Controller
{
    //

public function index()
{
    $cards = Card::where('user_id', auth()->user()->id)->get();

    return view('cards', compact('cards'));
}

public function create()
{


    $sets = Pokemon::Set()->all();
    
    return view('createcard', compact('sets'));
}


public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'type' => 'required',
        'rarity' => 'required',
        'image' => 'required|url', // Controleer of het een geldige URL is
    ]);

    auth()->user()->cards()->create([
        'name' => $data['name'],
        'type' => $data['type'],
        'rarity' => $data['rarity'],
        'image' => $data['image'], // Sla de URL rechtstreeks op in de database
    ]);

    return "Kaart is succesvol toegevoegd.";
}




public function image($id)
{
    $card = Card::findOrFail($id);

    // Bepaal het juiste contenttype op basis van het bestandsformaat
    if (strpos($card->image, 'jpeg') === 0) {
        $imageType = 'image/jpeg';
    } elseif (strpos($card->image, 'jpg') === 0) {
        $imageType = 'image/jpeg';
    } elseif (strpos($card->image, 'png') === 0) {
        $imageType = 'image/png';
    }

    return response()->stream(function () use ($card) {
        echo $card->image;
    }, 200, [
        'Content-Type' => $imageType,
    ]);
}


public function searchCard(Request $request)
{
    $setId = $request->input('setId');
    $cardName = $request->input('cardName');

if ($setId === 'All') {
    if ($cardName) {
        $cards = Pokemon::Card()->where(['name' => $cardName . '*'])->all();
    } else {
        // Haal alle kaarten op als $cardName null is
        $cards = Pokemon::Card()->all();
    }
} else {
    if ($cardName) {
        $cards = Pokemon::Card()->where(['set.id' => $setId, 'name' => $cardName])->all();
    } else {
        // Haal alle kaarten van een bepaalde set op als $cardName null is
        $cards = Pokemon::Card()->where(['set.id' => $setId])->all();
    }
}
       $formattedData = [];
    foreach ($cards as $card) {
        $formattedData[] = $card->toArray();
    }

    return response()->json($formattedData);

}

    public function show($id)
    {
        $card = Card::find($id);
        return view('card', compact('card'));
    }

}