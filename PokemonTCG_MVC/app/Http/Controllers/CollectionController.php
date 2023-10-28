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
        $collections = Collection::where('active', true)->get();
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
        $cards = Card::where('user_id', auth()->user()->id)->get(); 
        return view('collections.create', ['cards' => $cards]);
    }

    public function store(Request $request)
    {


        $cardIds = json_decode($request->input('cardids'), true);
    
        $validatedData = $request->validate([
            'name'=> 'required|string',
            'active' => 'required|boolean', 
            'cardids' => 'required', 
            'cardids.*' => 'required|exists:cards,id', 
            // Controleert of elk ID in de array bestaat in de kaarten database
        ]);
        
    
        $userid = auth()->user()->id;
    
        $collection = Collection::create([
            'userid' => $userid,
            'name' => $validatedData['name'], 
            'active' => $validatedData['active'],
            'quantity'=> count($cardIds),
        ]);
        $collection->cards()->attach($cardIds);
    
        return redirect('/collections')->with('success', 'Collection has been created.');
    }   
    
public function updateStatus(Request $request, $id)
{
    $collection = Collection::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'nullable|string',
    ]);

    $user = auth()->user();
    $userCreatedDate = $user->created_at; 
    $oneDayAgo = now()->subDays(1);

    if ($userCreatedDate <= $oneDayAgo) {
        $collection->active = $request->has('active');

        if ($request->has('name')) {
            $collection->name = $validatedData['name'];
        }

        $collection->save();

        return redirect('/collections/owned')->with('success', 'Collection status has been updated.');
    } else {
        return redirect('/collections/owned')->with('error', 'User cannot update collection status within one day of registration.');
    }
}


}