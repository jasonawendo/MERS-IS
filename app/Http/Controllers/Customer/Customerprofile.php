<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class Customerprofile extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        return view('Customer/profile.show', ['user' => $user]);
    }

    public function edit($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        return view('Customer/profile.edit', ['user' => $user]);
    }

    public function store()
    {
        $customerID = request('id');
        $customer = Users::findOrFail($customerID); //Find the record in the db of this id

        $img = request('profile');
        if(isset($img))
        {
            $newImageName = time(). '-' . request('fname') . request('lname') . '.' . request('profile')->extension(); //renames the image
            request('profile')->move(public_path('img'), $newImageName); //Moves uploaded file image into the public image folder
            $customer->profilepic = $newImageName;
        }
        $customer->mobilenumber = request('mobilenumber');
        $customer->address = request('address');
        $customer->linkedin = request('linkedin');
        $customer->websitelink = request('website');
        $customer->companyname = request('company');
        $customer->bio = request('bio');

        // error_log($customer);
        $customer->save();
        return redirect("/Customer/profile/$customerID")->with('msg','Your information has been updated successfully');
    }

}
