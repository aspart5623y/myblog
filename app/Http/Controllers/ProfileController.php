<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Repositories\ProfileRepository;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profiles.index');
    }

    public function edit()
    {
        return view('profiles.edit');
    }
    

    public function update(ProfileRequest $request, ProfileRepository $profileRepository, User $profile)
    {
        $validatedData = $request->validated();
        $user = $profileRepository->update($validatedData, $profile);
        return redirect()->route('profile.index')
                ->with('updated_profile', 'Your profile has been updated successfully!');
    }


    public function updateImage(ProfileRequest $request, ProfileRepository $profileRepository, User $profile)
    {
        $validatedImage = $request->validated();        
        if ($validatedImage) {
            $uploadedImage = $profileRepository->updateImage($validatedImage, $profile);
        } else {
            return back()->with('update_error', 'There was an error getting this file. Please try again');
            die();
        }

        return back()->with('updated_profile', 'Your profile picture has been updated successfully!');
    }


}
