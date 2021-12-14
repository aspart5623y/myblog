<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function editProfile()
    {
        return view('edit-profile');
    }



    public function updateImage(Request $request)
    {
        
        $id = Auth::user()->id;
        
        $user = User::find($id);
        
        if ($request->file('image') == null) {
            return back()->with('update_error', 'There was an error getting your image. Please try again');
            die();
        }

        if (Auth::user()->profile_image != '') {
            unlink(public_path('profile-images') . '/' . Auth::user()->profile_image);
        }
        
        $image = $request->file('image');
        // dd($image);
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('profile-images'), $imageName);
        $user->profile_image = $imageName;
        $user->save();

        return back()->with('updated_profile', 'Your profile picture has been updated successfully!');
    }



    public function updateProfile(Request $request)
    {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $username = $request->username;


        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => 'required',
            'email' => 'required|email'
        ]);

        $id = Auth::user()->id;

        $user = User::find($id);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->email = $email;
        $user->username = $username;
        $user->save();

        return redirect()->route('profile')
                ->with('updated_profile', 'Your profile has been updated successfully!');
    }

    public function render()
    {
        return view('profile');
    }
}
