<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card; 
use App\Models\Collection; 



class CollectionController extends Controller
{

    /**
     * Display the specified collection.
     *
     * @param int 
     * $id The ID of the collection to display.
     * @return \Illuminate\View\View 
     * Returns the view for displaying the specified collection.
     */
    public function show($id)
    {
        $collection = Collection::find($id); 
        return view('collections.show', compact('collection')); 
    }

    /**
     * Display a listing of active collections.
     *
     * @return \Illuminate\View\View 
     * Returns the view for displaying a listing of active collections.
     */
    public function index()
    {
        $collections = Collection::where('active', true)->get();
        return view('collections.index', compact('collections'));
    }

    /**
     * Display a listing of the user's collections.
     *
     * @return \Illuminate\View\View 
     * Returns the view for displaying the user's collections.
     */
    public function owned()
    {
        $user = auth()->user();
        $collections = Collection::where('userid', $user->id)->get();
        return view('collections.owned', compact('collections'));
    }
        
    /**
     * Show the form for creating a new collection.
     *
     * @return \Illuminate\View\View 
     * Returns the view for creating a new collection with the user's cards.
     */
    public function create()
    {
        // Fetch all cards belonging to the current authenticated user
        $cards = Card::where('user_id', auth()->user()->id)->get(); 
        return view('collections.create', ['cards' => $cards]);
    }

    /**
     * Store a newly created collection in the database.
     *
     * @param \Illuminate\Http\Request 
     * $request The HTTP request containing the collection data.
     * @return \Illuminate\Http\RedirectResponse 
     * Returns a redirect response after storing the collection.
     */
    public function store(Request $request)
    {
        // Decode the JSON array of card IDs
        $cardIds = json_decode($request->input('cardids'), true);
        
        // Validate the incoming request data for creating a new collection
        $validatedData = $request->validate([
            'name'=> 'required|string',
            'cardids' => 'required', 
            'cardids.*' => 'required|exists:cards,id', 
            // Check if each ID in the array exists in the cards database
        ]);
        
        // Get the user ID of the authenticated user
        $userid = auth()->user()->id;

        // Set the 'active' attribute based on the checkbox
        $active = $request->has('active') ? true : false;
        
        // Create a new collection with the validated data
        $collection = Collection::create([
            'userid' => $userid,
            'name' => $validatedData['name'], 
            'active' => $active,
            'quantity'=> count($cardIds),
        ]);

        // Attach the card IDs to the collection
        $collection->cards()->attach($cardIds);
        
        return redirect('/collections')->with('success', 'Collection has been created.');
    }
        
    /**
     * Update the status of a collection.
     *
     * @param \Illuminate\Http\Request 
     * $request The HTTP request containing the collection data.
     * @param int 
     * $id The ID of the collection to update.
     * @return \Illuminate\Http\RedirectResponse 
     * Returns a redirect response after updating the collection status.
     */
    public function updateStatus(Request $request, $id)
    {
        // Find the collection with the specified ID
        $collection = Collection::findOrFail($id);

        // Validate the incoming request data for updating the collection status
        $validatedData = $request->validate([
            'name' => 'nullable|string',
        ]);

        // Get the authenticated user and check the creation date
        $user = auth()->user();
        $userCreatedDate = $user->created_at; 
        $oneDayAgo = now()->subDays(1);

        // Check if the user is trying to update the collection status within one day of registration
        if ($userCreatedDate <= $oneDayAgo) {
            // Update the 'active' attribute based on the checkbox
            $collection->active = $request->has('active');

            // Update the 'name' attribute if it is present in the request
            if ($request->has('name')) {
                $collection->name = $validatedData['name'];
            }

            // Save the changes to the collection
            $collection->save();

            return redirect('/collections/owned')->with('success', 'Collection status has been updated.');
        } else {
            // Return an error message if the user tries to update the collection status within one day of registration
            return redirect('/collections/owned')->with('error', 'User cannot update collection status within one day of registration.');
        }
    }
}