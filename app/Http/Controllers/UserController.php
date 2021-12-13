<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function create(){
        return view('user_account.create');
    }

    public function update(Request $request, User $user){
        $attributes = $request->validate([
            'name'=>'max:255',
            'username'=>'max:255|min:3', // how to ensure no duplicates
            'email'=>'email|max:255',
            'password' => 'min:6|max:255|same:repeat_password',
            'repeat_password' => 'max:255|min:7',
        ]); 
        
        //$user->update($request->all());    
        //User::update($attributes);
        // User::update($attributes); // Send the successfuly requested attributed into the user creation template
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->name = $attributes["name"];
        $user->username = $attributes["username"];
        $user->password = $attributes["password"]; // Hashing already done at setPassword
        $user->save();


        session()->flash('success','Account has been updated');
        return redirect('/account');
    }

    public function destroy(){
        $user = Auth::user();
        $user_to_delete = User::find($user->id);
        // TODO: Deletion confirmation
        $user_to_delete->delete();
        return redirect('/');
    }
}
