<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::where('user_id', Auth::user()->id)->get(); 
        return view('author.comments', compact('comments')); 
    } 

    public function store(Request $request, $post)
    { 
        $this->validate($request, [
            'comment' => 'required'
        ]); 
        $comment = new Comment();
        $comment->post_id = $post;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back()->with('success', 'Comment Added'); 
    } 

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id); 
        if($comment->post->user->id == Auth::id()){
            $comment->delete();
            return redirect()->route('author.comment.index')->with('success', 'Data has been deleted successfully!');  
        }else { 
            return redirect()->back()->with('warning', 'An error has occurred please try again.');  
        } 
    }
}
