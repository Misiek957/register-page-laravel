<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post; //include the post class 
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    

    // ddd($document);
    // ddd($document->body());
    // ddd($document->matter("date")); // Equivalent to '$document->date'. Get the metadata as an array
    
    
    $posts = Post::get_all_posts();
    // // ddd($posts[1]-> getContents()); // Get contents of each post , 0 based 
    return view('posts',[
        'posts' => $posts
    ]);
});

Route::get('/posts/{post}', function ($slug) {

    // Simplification with class Post, in app\Models\Post.php
    $post = Post::find($slug); // Need for new Post class, 'Model'
    return view('post1', [
        'post_contents' => $post // access to $post_contents variable
    ]);

})->where('post','[A-z_\-]+');

Route::get('/users/{user:id}', function(User $user){ // Find user according to id, User::where('id',$user->firstorfail())
    return view('user',[
        'user' => $user
    ]);
});

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


Route::get('login',[SessionsController::class,'create'])->middleware('guest');
Route::post('login',[SessionsController::class,'store'])->middleware('guest');
Route::post('logout',[SessionsController::class, 'destroy'])->middleware('auth');

Route::get('account',[UserController::class, 'create'])->middleware('auth', 'bully');
// Route::get('account',[UserController::class, 'create'])->middleware('bully');
// Route::view('account','user_account.create')->middleware('bully');

Route::put('update',[UserController::class, 'update'])->middleware('auth');
Route::delete('delete',[UserController::class, 'destroy'])->middleware('auth');