<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    { 
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email', 
        ]);
        $image = $request->file('image'); 
        $slug  = Str::slug($request->name);
        $user  = User::findOrFail(Auth::id());
        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString(); 
            $imageName   = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension(); 
            if(!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile'); 
            }
            // Delete old image from profile folders 
            if(Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/' . $user->image); 
            }
            $profile = Image::make($image)->resize(500, 500)->stream();
            Storage::disk('public')->put('profile/' . $imageName, $profile); 
        }else{
            $imageName = $user->image; 
        }
        $user->name  = $request->name; 
        $user->email = $request->email;
        $user->about = $request->about; 
        $user->image = $imageName;
        $user->save(); 
        return redirect()->route('admin.settings')->with('success', 'Profile has been Saved successfully!');   
    }

    public function updatePassword(Request $request)
    { 
        if (!(Hash::check($request->old_password, Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        } 
        if(strcmp($request->old_password, $request->password) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }  

        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);  

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();  
        return redirect()->back()->with("success","Password successfully changed!");  
    }
}
