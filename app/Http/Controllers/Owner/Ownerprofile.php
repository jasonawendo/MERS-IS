<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class Ownerprofile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        return view('Owner/profile.show', ['user' => $user]);
    }

    public function edit($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        return view('Owner/profile.edit', ['user' => $user]);
    }

    public function store()
    {
        $ownerID = request('id');
        $owner = Users::findOrFail($ownerID); //Find the record in the db of this id

        $img = request('profile');
        if(isset($img))
        {
            $newImageName = time(). '-' . request('fname') . request('lname') . '.' . request('profile')->extension(); //renames the image
            request('profile')->move(public_path('img'), $newImageName); //Moves uploaded file image into the public image folder
            $owner->profilepic = $newImageName;
        }
        $owner->mobilenumber = request('mobilenumber');
        $owner->address = request('address');
        $owner->linkedin = request('linkedin');
        $owner->websitelink = request('website');
        $owner->companyname = request('company');
        $owner->bio = request('bio');

        // error_log($owner);
        $owner->save();
        return redirect("/Owner/profile/$ownerID")->with('msg','Your information has been updated successfully');
    }

}
