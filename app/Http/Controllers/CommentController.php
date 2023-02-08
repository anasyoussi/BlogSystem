<?php

namespace App\Http\Controllers;

use App\Models\Comment; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        // $comments = Comment::with('user')->latest()->get(); 
        $commentCount = Comment::count(); 
        return view('admin.comments', compact('comments', 'commentCount')); 
    } 

    public function store(Request $request, $postID)
    { 
        $this->validate($request, [
            'comment' => 'required'
        ]); 
        $comment = new Comment();
        $comment->post_id = $postID;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back()->with('success', 'Comment Added'); 
    } 

    public function destroy($id)
    {
        $comment = Comment::find($id); 
        if($comment->delete()){
            return redirect()->route('admin.comment.index')->with('success', 'Data has been deleted successfully!');  
        }else { 
            return redirect()->back()->with('warning', 'An error has occurred please try again.');  
        } 
    }

    
}
