<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Display listing of the resrouce 
     * 
     */
    public function index(){

    }
    
    public function create(){
        return view('register.create');
    }

    // Register post request
    public function store(){
        //CSRF (Cross Site request forgery) Error 419 prevention, supply unique token
        // If validation fails, redirect 
        $attributes = request()->validate([
            'name'=>'required|max:255',
            'username'=>'required|max:255|min:3|unique:users,username', // unique:table,column
            'email'=>'required|email|max:255|unique:users,email',
            'password' => 'min:6|max:255|required_with:repeat_password|same:repeat_password',
            'repeat_password' => 'max:255|min:7',
        ]); 
        // Create user in database
        $user = User::create($attributes); // Send the successfuly requested attributed into the user creation template

        //Login
        Auth::login($user);

        // Flash user with message
        session()->flash('success','Account has been created'); // flash(key, value)

        return redirect('/'); // Redirect to home page if successful
    }
}
