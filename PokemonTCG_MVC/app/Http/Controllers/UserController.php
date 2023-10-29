<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Http\Requests\UpdateUserRequest;


class UserController extends Controller
{
    /**
     * Display a listing of all users.
     *
     * @return \Illuminate\View\View 
     * Returns the view for displaying a listing of all users.
     */
    public function index()
    {
        // Retrieve all users
        $users = User::all(); 

        // Return the view with the retrieved users
        return view('users.index', compact('users')); 
    }

    // /**
    //  * Display the specified user.
    //  *
    //  * @param int 
    //  * $id The ID of the user to display.
    //  * @return \Illuminate\View\View 
    //  * Returns the view for displaying the specified user.
    //  */
    // public function show($id)
    // {
    //     // Find the user with the specified ID
    //     $user = User::find($id); 

    //     // Return the view with the retrieved user
    //     return view('users.show', compact('user')); 
    // }

    /**
     * Delete the specified user.
     *
     * @param int 
     * $id The ID of the user to delete.
     * @return \Illuminate\Http\RedirectResponse 
     * Returns a redirect response after deleting the user.
     */
    public function delete($id)
    {
        // Find the user with the specified ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Gebruiker niet gevonden');
        }

        // Delete all collections associated with the user
        foreach ($user->collections as $collection) {
            $collection->delete();
        }

        // Delete the user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Gebruiker succesvol verwijderd');
    }


    public function show()
    {
        $user = auth()->user();

        return view('users.show', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = auth()->user();

        $validatedData = $request->validated();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        $user->save();

        return redirect()->route('users.show')->with('success', 'User updated successfully');
    }
}