<?php

namespace App\Http\Controllers;
 
use App\Models\Post; 
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function getSingle(Post $post) {

        $randomposts = Post::take(3)->inRandomOrder()->get();
        $postCount = $post->comments->count();
        $postComments = $post->comments; 
         
    
        $blogKey = 'blog_' . $post->id; 
        if(!Session::has($blogKey))
        {
            $post->increment('view_count'); 
            Session::put($blogKey, 1); 
        } 
        return view('post', compact('post','postCount','postComments', 'randomposts'));  
    }

    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts', compact('posts')); 
    }


    public function details($slug)
    {
        $post = Post::find(22)->get();
        dd(Post::find(22)->comments, Post::find(22)->comments->count()); 

        // Views: 
        $blogKey = 'blog_' . $post->id; 
        if(!Session::has($blogKey))
        {
            $post->increment('view_count'); 
            Session::put($blogKey, 1); 
        } 
        return view('post', compact('post'));  
    }
}
