<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:subscribers,email,except,id'
        ]);
        $sub = new Subscriber;
        $sub->email = $request->email;
        $sub->save(); 
        return redirect()->back()->with('success', 'You Successfully added to our subscriber list !');   
    }
}
