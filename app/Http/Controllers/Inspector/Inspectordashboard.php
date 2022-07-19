<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Inspectordashboard extends Controller
{
    public function index()
    {
        // //Equipment listings count
        // $equipment = Equipmentlisting::where('status', 'accepted')->where('isDeleted', '0')->count();
        // //Orders Count
        // $orders = Orders::where('isDeleted', '0')->count();
        // //Add up total revenue
        // $revenue = Orders::where('paymentStatus', '1')->where('isDeleted', '0')->sum('amount');
        // //Equipmentlisting request count
        // $listingrequest = Equipmentlisting::where('status', 'pending')->where('isDeleted', '0')->count();
        // //Rejected listing requests count
        // $rejectedrequest = Equipmentlisting::where('status', 'rejected')->where('isDeleted', '0')->count();
        // //Rental requests count
        // $rentals = Rentals::where('inspectionStatus', 'pending')->where('OwnerStatus', 'pending')->where('isDeleted', '0')->count();
        // //Inspection job count
        // $jobs = Inspectionjobs::where('isDeleted', '0')->count();

        return view('Inspector/dashboard');
        // ->with('requests', $requests)
        // ->with('users', $users)
        // ->with('equipment', $equipment);
    }
}
