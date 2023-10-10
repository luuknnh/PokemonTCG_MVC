<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card; 


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
    return view('createcard');
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'type' => 'required',
        'rarity' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Controleer bestandstype en grootte
    ]);

    if ($request->hasFile('image')) {
        $image = base64_encode(file_get_contents($request->file('image')->getRealPath()));
        auth()->user()->cards()->create([
            'name' => $data['name'],
            'type' => $data['type'],
            'rarity' => $data['rarity'],
            'image' => $image, // Sla de base64-gecodeerde gegevens op in de database
        ]);
    }

    return redirect()->route('cards.index')->with('success', 'Kaart is succesvol toegevoegd.');
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



    public function show($id)
    {
        $card = Card::find($id);
        return view('card', compact('card'));
    }

}
