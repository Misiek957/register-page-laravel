<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    // View the logic page from get request
    public function create(){
        return view('sessions.create');
    }

    
    public function store(){
        // validate the request
        $credentials = request()->validate([
            'username' => 'required', // validate if username exists in db(table,column)
            'password' => 'required'
        ]);
        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (Auth::attempt($credentials)){ // Auth::attemps signs in and confirms
            // session fixation
            session()->regenerate();

            // redirect with flash message
            return redirect('/')->with('success','Logged in');
        }
        // Auth failed
        return back()
            ->withInput() // Store input fields
            ->withErrors(['username'=>'Incorrect username or password.']); // Error message under field
        
    }
    // Log the user out from post in logout
    public function destroy(){
        Auth::logout();
        return redirect('/')->with('success','Logged out');
    }
}
