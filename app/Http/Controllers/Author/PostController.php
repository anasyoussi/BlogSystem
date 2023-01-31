<?php

namespace App\Http\Controllers\Author;

use App\Notifications\NewAuthorPost;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();  
        return response()->view('author.post.index', compact('posts')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get(); 
        $tags       = Tag::latest()->get(); 
        return response()->view('author.post.create', compact('categories', 'tags')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required',
            'image'         => 'required',
            'categories'    => 'required',
            'tags'          => 'required',
            'editor1'       => 'required', 
        ]);
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image)){
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('posts'); 
            }
            
            $postImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/' . $imageName, $postImage); 
        } else {
            $imageName = 'default.png';
        }
        $post = new Post(); 
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->editor1; 
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;  
        }
        $post->is_approved = false;
        $post->save();
        
        $users = User::where('role_id', 1)->get();
        Notification::send($users, new NewAuthorPost($post)); 
        
        $post->tags()->attach($request->tags); 
        $post->categories()->attach($request->categories); 


        
        return redirect()->route('author.post.index')->with('success', 'Post has been saved successfully!');   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(!Auth::user() || Auth::user()->id != $post->user_id){
            abort(403);
        } else {
            return view('author.post.show', compact('post'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!Auth::user() || Auth::user()->id != $post->user_id){
            abort(403);
        }else{
            $categories = Category::latest()->get();
            $tags = Tag::latest()->get();
            return response()->view('author.post.edit', compact('post', 'categories', 'tags')); 
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id); 
        $this->validate($request, [
            'title'         => 'required', 
            'categories'    => 'required',
            'tags'          => 'required',
            'editor1'       => 'required', 
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image)){

            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post'))
            {
                Storage::disk('public')->makeDirectory('posts'); 
            }

            // delete old image 
            if(Storage::disk('public')->exists('post/'.$post->image)){
                Storage::disk('public')->delete('post/'.$post->image); 
            }

            $postImage = Image::make($image)->resize(1600, 1066)->stream();
            Storage::disk('public')->put('post/' . $imageName, $postImage); 

            

        } else {
            $imageName = $post->image; 
        } 

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->editor1; 

        if( isset($request->status) ){
            $post->status = true;
        } else {
            $post->status = false;  
        }

        $post->is_approved = false;
        $post->save();
        
        $post->tags()->sync($request->tags); 
        $post->categories()->sync($request->categories); 
        
        return redirect()->route('author.post.index')->with('success', 'Post has been updated successfully!');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id); 
        if ($post->user_id != Auth::id())
        {
            exit();
            return redirect()->back()->with('error', 'You are not authorized to access this post');   
        }

        if (Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        
        $post->categories()->detach();
        $post->tags()->detach(); 

        $post->delete();

        return redirect()->route('author.post.index')->with('success', 'Post has been Deleted Successfully!');   
    }
}
