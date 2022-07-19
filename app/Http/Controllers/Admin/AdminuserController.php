<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Users; //Links the User Model for us to use inside the controller

class AdminuserController extends Controller
{
    public function indexRegrequests()
    {
        // $users = Users::all();
        $user = Users::
        whereNot('status', 'accepted')
        ->where('isDeleted', '0')
        ->where(function($query) 
                {
                    $query
                    ->where('role', 'Customer')
                    ->orWhere('role', 'Equipment Owner');
                })
        ->get();
        // return view('Admin/users.index');
        
        return view('Admin/users.index', ['users' => $user], ['title' => 'View Registration Requests']);
    }

    public function indexCustomers()
    {
        // $users = Users::all();
        $user = Users::
        where('status', 'accepted')
        ->where('role', 'customer')
        ->where('isDeleted', '0')
        ->get();
        // return view('Admin/users.index');
        return view('Admin/users.index', ['users' => $user], ['title' => 'View Customers']);
    }

    public function indexOwners()
    {
        // $users = Users::all();
        $user = Users::
        where('status', 'accepted')
        ->where('role', 'Equipment Owner')
        ->where('isDeleted', '0')
        ->get();
        // return view('Admin/users.index');
        return view('Admin/users.index', ['users' => $user], ['title' => 'View Equipment Owners']);
    }

    public function indexRemoved()
    {
        // $users = Users::all();
        $user = Users::
        where('status', 'accepted')
        ->where('isDeleted', '1')
        ->whereNot('role', 'Admin')
        ->get();
        // return view('Admin/users.index');
        return view('Admin/users.index', ['users' => $user], ['title' => 'View Removed Users']);
    }

    public function show($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        return view('Admin/users.show', ['user' => $user]);
    }

    public function remove($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        $user->isDeleted = request('isDeleted');
        $user->save();
        return redirect('/Admin/users/removed')->with('msg','User has been removed succesfully');

        // error_log(request('isDeleted'));
    }

    public function accept($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        $user->status = request('status');
        $user->save();
        return redirect('/Admin/users/requests')->with('msg','User has been added to the system succesfully');

        // error_log(request('isDeleted'));
    }

    public function reject($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        $user->status = request('status');
        $user->save();
        return redirect('/Admin/users/requests')->with('msg','User registration request has been rejected succesfully');

        // error_log(request('isDeleted'));
    }
}
