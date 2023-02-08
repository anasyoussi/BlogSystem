<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::authors()
            ->withCount('posts')
            ->withCount('comments')
            ->withCount('favorite_posts')
            ->get();
        // return $authors; 
        return view('admin.authors', compact('authors')); 
    } 
    public function destroy($id)
    {
        $author = User::findOrFail($id)->delete(); 
        return redirect()->back()->with('success', 'Author Deleted'); 
    }
}
