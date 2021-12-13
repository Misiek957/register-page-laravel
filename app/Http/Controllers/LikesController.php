<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Likes;

class LikesController extends Controller
{
    public function store(Request $request, $post_id){
        if (Auth::user() == null){ // Check if user logged in
            return redirect('/')->with('success','You must be logged in to like');
        }
        // elseif (Auth::user() == 10) { // Check if user already liked post
        //     # code...
        // }
        else {
            $like = new Likes([
                'post_id' => $post_id,
                'user_id' => Auth::user()->id
            ]);
            $like->save();
            session()->flash('success','Post');
            return redirect('/');
        }
    }
}
