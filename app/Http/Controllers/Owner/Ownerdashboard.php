<?php

namespace App\Http\Controllers\Owner;

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
use Carbon\Carbon;

class Ownerdashboard extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner
        
        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateTimeString(); //Gets the current date

        $pendingRR = Rentals::
        where('rentals.inspectionStatus', 'accepted')
        ->where('rentals.ownerStatus', 'accepted')
        ->whereDate('rentals.dateTimeEnd', '<' , $date)
        ->where('rentals.isDeleted', '0')
        ->where('rentals.isRated', '0') //New field. If rated, dont display.

        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        ->count();

        $listingrequests = Equipmentlisting::
        where('ownerID', $ownerID)
        ->where('status', 'pending')
        ->where('isDeleted', '0')
        ->count();

        $listings = Equipmentlisting::
        where('ownerID', $ownerID)
        ->where('status', 'accepted')
        ->where('isDeleted', '0')
        ->count();

        $pendingRequests = Rentals::
        where('rentals.inspectionStatus', 'pending')
        ->where(function($query) 
                {
                    $query
                    ->where('rentals.OwnerStatus', 'pending')
                    ->orWhere('rentals.OwnerStatus', 'accepted');
                })
        ->where('rentals.isDeleted', '0')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        ->count();

        $rejectedRentalRequests = Rentals::
        where(function($query) 
                {
                    $query
                    ->where('rentals.inspectionStatus', 'rejected')
                    ->orWhere('rentals.OwnerStatus', 'rejected');
                })
        ->where('rentals.isDeleted', '0')
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        ->count();

        $rejectedlistings = Equipmentlisting::
        where('ownerID', $ownerID)
        ->where('status', 'rejected')
        ->count(); //where status is rejected and isDeleted=0

        return view('Owner/dashboard')
        ->with('pendingRR', $pendingRR)
        ->with('listings', $listings)
        ->with('listingrequests', $listingrequests)
        ->with('pendingRequests', $pendingRequests)
        ->with('rejectedRentalRequests', $rejectedRentalRequests)
        ->with('rejectedlistings', $rejectedlistings);
    }
}
