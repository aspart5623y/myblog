<?php

namespace App\Repositories;

class ProfileRepository {
    public function update($data, $profile)
    {

        $profile->firstname = $data['firstname'];
        $profile->lastname = $data['lastname'];
        $profile->email = $data['email'];
        $profile->username = $data['username'];
        $profile->save();

        if ($profile) {
            return $profile;
        } else {
            return response()->json('Error saving data', 500);
        }

    }


    public function updateImage($image, $profile)
    {

        $image = $image['image'];

        if ($profile->profile_image != '') {
            unlink(public_path('profile-images') . '/' . $profile->profile_image);
        }

        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('profile-images'), $imageName);
        $profile->profile_image = $imageName;
        $profile->save();

        if ($profile) {
            return $profile;
        } else {
            return response()->json('Error updating profile picture', 500);
        }

    }
}