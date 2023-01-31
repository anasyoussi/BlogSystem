<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts', compact('posts')); 
    }


    public function details($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categories = Category::all(); 
        $postCatName = $post->categories[0]->name;
        $postCatImg = $post->categories[0]->image;
        $postTags = $post->tags; 
        $randomposts = Post::all()->random(3);


        // Views: 
        $blogKey = 'blog_' . $post->id; 
        if(!Session::has($blogKey))
        {
            $post->increment('view_count'); 
            Session::put($blogKey, 1); 
        }

        return view('post', compact('post', 'randomposts', 'postCatName', 'postCatImg', 'postTags', 'categories'));  
    }
}
