<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Orders;
use App\Models\Equipmentlisting;
use App\Models\Rentals;
use App\Models\Rrcustomers;
use App\Models\Rrowners;
use App\Models\Inspectionjobs;
use App\Models\Inspectiontasks;

class Admindashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Registration requests count
        $requests = Users::
        where('status', 'pending')
        ->where('isDeleted', '0')
        ->where(function($query) 
                {
                    $query
                    ->where('role', 'Customer')
                    ->orWhere('role', 'Equipment Owner');
                })
        ->count();

        //Registered users count
        $users = Users::
        where('status', 'accepted')
        ->where(function($query) 
                {
                    $query
                    ->where('role', 'Customer')
                    ->orWhere('role', 'Equipment Owner');
                })
        ->where('isDeleted', '0')
        ->count();

        //Equipment listings count
        $equipment = Equipmentlisting::where('status', 'accepted')->where('isDeleted', '0')->count();
        //Orders Count
        $orders = Orders::where('isDeleted', '0')->count();
        //Add up total revenue
        $revenue = Orders::where('paymentStatus', '1')->where('isDeleted', '0')->sum('amount');
        //Equipmentlisting request count
        $listingrequest = Equipmentlisting::where('status', 'pending')->where('isDeleted', '0')->count();
        //Rejected listing requests count
        $rejectedrequest = Equipmentlisting::where('status', 'rejected')->where('isDeleted', '0')->count();
        //Rental requests count
        $rentals = Rentals::where('inspectionStatus', 'pending')->where('OwnerStatus', 'pending')->where('isDeleted', '0')->count();
        //Inspection job count
        $jobs = Inspectionjobs::where('isDeleted', '0')->count();

        return view('Admin/dashboard')
        ->with('requests', $requests)
        ->with('users', $users)
        ->with('equipment', $equipment)
        ->with('listingrequest', $listingrequest)
        ->with('rejectedrequest', $rejectedrequest)
        ->with('orders', $orders)
        ->with('revenue', $revenue)
        ->with('rentals', $rentals)
        ->with('jobs', $jobs);
    }
}
