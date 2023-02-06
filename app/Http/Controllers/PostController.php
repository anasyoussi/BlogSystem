<?php

namespace App\Http\Controllers;
 
use App\Models\Post; 
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    // public function getSingle(Post $post) {

    //     $randomposts = Post::take(3)->inRandomOrder()->get();
    //     $postCount = $post->comments->count();
    //     $postComments = $post->comments ;

    //     // return $post->comments;
         
    
    //     $blogKey = 'blog_' . $post->id; 
    //     if(!Session::has($blogKey))
    //     {
    //         $post->increment('view_count'); 
    //         Session::put($blogKey, 1); 
    //     } 
    //     return view('post', compact('post','postCount','postComments', 'randomposts'));  
    // }

    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts', compact('posts')); 
    }


    public function details($slug)
    {
        $randomposts = Post::take(3)->inRandomOrder()->get();
        $post = Post::where('slug', strtolower($slug))->first();
        $comments = $post->latestComments; 

        $commentCount = $post->comments->count();
        // Post detail :
        $postID = $post->id;
        $postImage = $post->image;
        $postTitle = $post->title;
        $postBody = $post->body;
        $postTags = $post->tags; 
        $postCategories = $post->categories; 

 

        // Views: 
        $blogKey = 'blog_' . $post->id; 
        if(!Session::has($blogKey))
        {
            $post->increment('view_count'); 
            Session::put($blogKey, 1); 
        } 
        return view('post', compact('post', 'postID', 'postTitle', 'postBody', 'postTags', 'postCategories', 'postImage', 'randomposts', 'comments', 'commentCount'));  
    }
}
