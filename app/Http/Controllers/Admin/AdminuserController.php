<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users; //Links the User Model for us to use inside the controller
use App\Models\Rrcustomers;
use App\Models\Rrowners;
use Illuminate\Support\Facades\Hash;

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
        ->get();
        // return view('Admin/users.index');
        return view('Admin/users.index', ['users' => $user], ['title' => 'View Removed Users']);
    }

    public function indexAdmin()
    {
        // $users = Users::all();
        $user = Users::where('role', 'admin')
        ->where('isDeleted', '0')
        ->get();
        // return view('Admin/users.index');
        return view('Admin/users.index', ['users' => $user], ['title' => 'View Admin']);
    }

    public function createAdmin()
    {
        return view('Admin/users.create_admin');
    }

    public function storeAdmin()
    {
        $role = "Admin";
        $status = "accepted";

        //Encrypting admin password
        $password = request('password');
        $encryptedPassword = Hash::make($password);

        $admin = new Users();
        $admin->fname = request('fname');
        $admin->lname = request('lname');
        $admin->email = request('email');
        $admin->password = $encryptedPassword;
        $admin->mobilenumber = request('mobilenumber');
        $admin->krapin = request('krapin');
        $admin->address = request('address');
        $admin->role = $role;
        $admin->status = $status;
        $admin->nationalid = request('nationalid');

        $admin->save();
        return redirect('/Admin')->with('msg','New Admin account added successfully');


        
    }

    public function show($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        return view('Admin/users.show', ['user' => $user]);
    }

    public function showRating($role, $userID)
    {
        if($role == "Customer")
        {
            $user = Users::findOrFail($userID); //Find the record in the db of this id
            $rr = Rrcustomers::
            where('isDeleted', '0')
            ->where('customerID', $userID)
            ->get();
            return view('Admin/rr.show_customer', ['user' => $user], ['rrs' => $rr], ['title' => 'View Customer Ratings and Reviews']);
        }
        else
        {
            $user = Users::findOrFail($userID); //Find the record in the db of this id
            $rr = Rrowners::
            where('isDeleted', '0')
            ->where('ownerID', $userID)
            ->get();
            return view('Admin/rr.show_owner', ['user' => $user], ['rrs' => $rr], ['title' => 'View Owner Ratings and Reviews']);
        }
        
    }

    public function remove($userID)
    {
        $this->removeUser($userID);
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
