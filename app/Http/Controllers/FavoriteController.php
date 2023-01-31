<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($post)
    {
        $user = User::find(Auth::user()->id);
        $isFavorite = $user->favorite_posts()->where('post_id', $post)->count(); 

        if($isFavorite == 0)
        {
            $user->favorite_posts()->attach($post); 
            return redirect()->back()->with('success', 'Like Added');    
        } else {
            $user->favorite_posts()->detach($post); 
            return redirect()->back()->with('success', 'Unliked'); 
        }
    }
}
