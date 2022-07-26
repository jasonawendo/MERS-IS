<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;

class Inspectorprofile extends Controller
{
    public function show($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        return view('Inspector/profile.show', ['user' => $user]);
    }

    public function edit($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        return view('Inspector/profile.edit', ['user' => $user]);
    }

    public function store()
    {
        $inspectorID = request('id');
        // dd($inspectorID);
        $img = request('profile');

        $inspector = Users::findOrFail($inspectorID); //Find the record in the db of this id

        if(isset($img))
        {
            $newImageName = time(). '-' . request('fname') . request('lname') . '.' . request('profile')->extension(); //renames the image
            request('profile')->move(public_path('img'), $newImageName); //Moves uploaded file image into the public image folder
            $inspector->profilepic = $newImageName;
        }
        $inspector->mobilenumber = request('mobilenumber');
        $inspector->address = request('address');
        



        // error_log($inspector);
        $inspector->save();
        return redirect("/Inspector/profile/$inspectorID")->with('msg','Your information has been updated successfully');
    }

}
