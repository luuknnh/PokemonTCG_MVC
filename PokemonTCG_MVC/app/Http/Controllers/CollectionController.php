<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card; 
use App\Models\Collection; 



class CollectionController extends Controller
{

    public function show($id)
    {
        $collection = Collection::find($id); 

        return view('collections.show', compact('collection')); 
    }

    public function index() {
        $collections = Collection::all(); 
        return view('collections.index', compact('collections'));
    }

    public function owned()
    {
        $user = auth()->user();
        $collections = Collection::where('userid', $user->id)->get();
        return view('collections.owned', compact('collections'));
    }
    
    public function create()
    {
        $cards = Card::all(); 
        return view('collections.create', ['cards' => $cards]);
    }

    public function store(Request $request)
    {


        $cardIds = json_decode($request->input('cardids'), true);
    
        $validatedData = $request->validate([
            'name'=> 'required|string',
            'cardids' => 'required', 
            'cardids.*' => 'required|exists:cards,id', 
            // Controleert of elk ID in de array bestaat in de kaarten database
        ]);
        
    
        $userid = auth()->user()->id;
    
        $collection = Collection::create([
            'name' => $validatedData['name'], 
            'userid' => $userid,
            'quantity'=> count($cardIds),
        ]);
        $collection->cards()->attach($cardIds);
    
        return redirect('/collections')->with('success', 'Collectie is succesvol aangemaakt.');
    }   
    
}
