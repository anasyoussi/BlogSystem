<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $posts = User::find(Auth::user()->id)->favorite_posts;
        return view('user.favorite', compact('posts'));
    }
}
