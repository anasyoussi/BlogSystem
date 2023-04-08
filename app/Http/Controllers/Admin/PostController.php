<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\NewAuthorPost;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Tag;
use App\Notifications\AuthorPostApproved;
use App\Notifications\NewPostNotify;
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
        $posts      = Post::latest()->get();
        $categories = Category::latest()->get(); 
        $tags       = Tag::latest()->get(); 
        return response()->view('admin.post.index', compact('posts', 'categories', 'tags')); 
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
        return response()->view('admin.post.create', compact('categories', 'tags')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->categories, $request->tags); 
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
        $post->slug = $slug . '-' . rand(1000, 9999);
        $post->image = $imageName;
        $post->body = $request->editor1; 
        if(isset($request->status)){
            $post->status = true;
        }else{
            $post->status = false;  
        }
        $post->is_approved = true;
        $post->save();

        // $subscribers = Subscriber::all();

        // foreach($subscribers as $subscriber){
        //     Notification::route('mail', $subscriber->email)->notify(new NewPostNotify($post));       
        // }
        
        $post->tags()->attach($request->tags); 
        $post->categories()->attach($request->categories); 
        
        // return response()->back()->with('success', 'Post has been saved successfully!');   
         return redirect()->route('admin.post.index')->with('success', 'Post has been saved successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    { 
        return view('admin.post.show', compact('post')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        return response()->view('admin.post.edit', compact('post', 'categories', 'tags')); 
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

        $post->is_approved = true;
        $post->save();
        
        $post->tags()->sync($request->tags); 
        $post->categories()->sync($request->categories); 
        
        return redirect()->route('admin.post.index')->with('success', 'Post has been updated successfully!'); 
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
        if (Storage::disk('public')->exists('post/'.$post->image))
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }
        
        $post->categories()->detach();
        $post->tags()->detach(); 

        $post->delete();
        return redirect()->route('admin.post.index')->with('success', 'Post has been Deleted Successfully!');   
    }
    
    public function pending()
    {
        $posts = Post::where('is_approved', false)->get();
        return view('admin.post.pending', compact('posts'));
    }

    public function approval($id)
    {
        $post = Post::find($id); 
        if($post->is_approved == false){
            $post->is_approved = true; 
            $post->save(); 
            $post->user->notify(new AuthorPostApproved($post)); 
            return redirect()->route('admin.post.index')->with('success', 'Post has been Approved Successfully!');   
        }else {
            return redirect()->route('admin.post.index')->with('info', 'Already Approved! ');   
        }
        return redirect()->back(); 
    }
    
}
