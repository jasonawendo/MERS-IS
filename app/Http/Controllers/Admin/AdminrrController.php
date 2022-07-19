<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Rrcustomers;
use App\Models\Rrowners;
use App\Models\Users;
class AdminrrController extends Controller
{
    public function indexCustomers()
    {
        $rr = Rrcustomers::
        where('isDeleted', '0')
        ->get();
        return view('Admin/rr.index_customer', ['rrs' => $rr]);
    }

    public function indexOwners()
    {
        $rr = Rrowners::
        where('isDeleted', '0')
        ->get();
        return view('Admin/rr.index_owner', ['rrs' => $rr]);
    }

    public function indexUsers()
    {
        
        $user = Users::
        where('averageRating', '<', '4')
        ->where('isDeleted', '0')
        ->where(function($query) 
                {
                    $query
                    ->where('role', 'Customer')
                    ->orWhere('role', 'Equipment Owner');
                })
        ->get();
        // return view('Admin/users.index');
        
        return view('Admin/rr.index_lrusers', ['users' => $user]);
    }

    public function showCustomers($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        $rr = Rrcustomers::
        where('isDeleted', '0')
        ->where('customerID', $userID)
        ->get();
        return view('Admin/rr.show_customer', ['user' => $user], ['rrs' => $rr], ['title' => 'View Customer Ratings and Reviews']);
    }

    public function showOwners($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        $rr = Rrowners::
        where('isDeleted', '0')
        ->where('ownerID', $userID)
        ->get();
        return view('Admin/rr.show_owner', ['user' => $user], ['rrs' => $rr], ['title' => 'View Owner Ratings and Reviews']);
    }


}
