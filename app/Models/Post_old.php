<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File; //Facade - Static access to functionalities 
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post{
    use HasFactory;
    // Metadata to be stored in the cache
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    // Constructor
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug; 
    }

    public static function find_old($slug){

        // base_path() //path base of the install
        // app_path()   
        // resource_path()
        // $path = __DIR__ . "/../resources/posts/{$slug}.html";
        $path = resource_path("/posts/{$slug}.html");

        // If path doesnt exist
        if (! file_exists($path)){
            // ddd('file does not exist'); // Die, Dump, Debug
            // abort(404); // Send error code
            // return redirect('/'); // rederict to home page
            throw new ModelNotFoundException(); // Exception we couldn't find post
        }

        // Caching -> remember(unique key, duration,)
        return cache()->remember("posts.{$slug}", now() -> addDay() ,fn() => file_get_contents($path));
        // cache()->remember("posts.{$slug}", now()->addDays(5), function() use ($path){
        //     // var_dump('file_get_contents')
        //     return file_get_contents($path); 
        // });
    } // end find()


    public static function get_all_posts(){
        //$files = File::files(resource_path("posts"));
        //$posts = [];
        
        return cache()->rememberForever('posts.all', function(){
            //Further collection optimisation cleanup
            $files = File::files(resource_path("posts"));
            $posts = collect($files)
            ->map(function($file){ // For each file
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($document){  // For each document
                return new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                );
            })->sortBy('date');
            return $posts;
        });

        // //For each map with collection
        // $posts = collect($files)
        // ->map(function ($file){ // For each file
        //     $document = YamlFrontMatter::parseFile($file);
        //     return new Post(
        //         $document->title,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body(),
        //         $document->slug
        //     );
        // });
    
        // // For each map with array_map()
        // $posts = array_map(function ($file){
        //     $document = YamlFrontMatter::parseFile($file);
        //     return new Post(
        //         $document->title,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body(),
        //         $document->slug
        //     );
        // }, $files); // foreach file in file
    
        // // For each map 1
        // foreach ($files as $file){
        //     $document = YamlFrontMatter::parseFile($file);
        //     $posts[] = new Post(  //Initialise the constructor with parsed meta
        //         $document->title,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body(),
        //         $document->slug
        //     );
        // }; 

        
        // $files = File::files(resource_path("posts/")); // read a directory of files   
        // return array_map (function($file) { // array map is a loop returning an array
        //     return $file->getContents(); // item in the array, FILE
        // }, $files); // what I'm looking over
    } // end get_all_posts()

    public static function find($slug){
        // of all the blog posts, fidn the one with a slug that matches the one that was requested
        $posts = static::get_all_posts();
        return $posts->firstWhere('slug', $slug); // Matches where first slug == $slug
    }


}

?>