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

class Reports extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Pending rental requests
        $pending = Rentals::where('inspectionStatus', 'pending')->where('OwnerStatus', 'pending')->where('isDeleted', '0')->count();
        //Accepted rental requests
        $accepted = Rentals::where('inspectionStatus', 'accepted')->where('OwnerStatus', 'accepted')->where('isDeleted', '0')->count();
        //Rejected rental requests
        $rejected = Rentals::where('inspectionStatus', 'rejected')->orWhere('OwnerStatus', 'rejected')->where('isDeleted', '0')->count();

        $customers = Users::where('status', 'accepted')->where('role', 'Customer')->where('isDeleted', '0')->count();
        $owners = Users::where('status', 'accepted')->where('role', 'Equipment Owner')->where('isDeleted', '0')->count();
        
        return view('Admin/reports')
        ->with('pending', $pending)
        ->with('accepted', $accepted)
        ->with('rejected', $rejected)
        ->with('customers', $customers)
        ->with('owners', $owners);
    }
}
