<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->get(); 
        return response()->view('admin.subscriber', compact('subscribers')); 
    }

    public function destroy($subscriber)
    {
        $subscriber = Subscriber::findOrFail($subscriber)->delete();  
        return redirect()->route('admin.subscriber.index')->with('success', 'Email Deleted Successfully!'); 
    }
}
