<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rentals;
use App\Models\Equipmentlisting;
use App\Models\Inspectiontasks;
use Carbon\Carbon;

class OwnerrentalController extends Controller
{
    public function indexReqPending()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner
        
        $rental = Rentals::
        where('rentals.inspectionStatus', 'pending')
        ->where(function($query) 
                {
                    $query
                    ->where('rentals.OwnerStatus', 'pending')
                    ->orWhere('rentals.OwnerStatus', 'accepted');
                })
        ->where('rentals.isDeleted', '0')
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        ->get();

        return view('Owner/rentals.index', ['rentals' => $rental], ['title' => 'View Pending Rental Requests']);
    }

    public function rentalResponse($rentalID, $status, $equipmentID)
    {
        $rental = Rentals::findOrFail($rentalID); //Find the record in the db of this id
        $rental -> OwnerStatus = $status;
        $rental ->save();

        if($status == "accepted") //Creates a corresponding inspection task once accepted by Owner, else if rejected, doesnt create a task
        {
            $deadline = Carbon::create($rental -> dateTimeStart)->subDays(7); //Deadline of inspecion task should be 7 days before the Startdatetime of rental
            $description = "Check equipment for rental request";

            $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
            $address = $equipment->address;
            
            $task = new Inspectiontasks(); 
            $task->taskDescription = $description;
            $task->address = $address;
            $task->rentalID = $rentalID;
            $task->deadline = $deadline;
            $task->save();

            return redirect('/Owner/rentals/requests/pending')->with('msg','Rental request has been accepted. Awaiting Inspection.'); 
        }
        else
        {
            return redirect('/Owner/rentals/requests/pending')->with('msg','Rental request has been rejected.'); 
        }
        
    }

    public function indexReqRejected()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner
        
        $rental = Rentals::
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
        ->get();

        return view('Owner/rentals.index', ['rentals' => $rental], ['title' => 'View Rejected Rental Requests']);
    }

    public function indexRentalStart()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $dt = Carbon::now()->setTimezone('Africa/Nairobi'); //Gets the current date
        $datetime = $dt->toDateTimeString(); 
        
        $rental = Rentals::
        where('rentals.inspectionStatus', 'accepted')
        ->where('rentals.OwnerStatus', 'accepted')
        ->where('rentals.isDeleted', '0')
        ->whereDate('rentals.dateTimeStart', '>' , $datetime)
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        ->get();

        return view('Owner/rentals.index', ['rentals' => $rental], ['title' => 'View Starting rentals']);
    }

    public function indexRentalOngoing()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $dt = Carbon::now()->setTimezone('Africa/Nairobi'); //Gets the current date
        $datetime = $dt->toDateTimeString(); 
        
        $rental = Rentals::
        where('rentals.inspectionStatus', 'accepted')
        ->where('rentals.OwnerStatus', 'accepted')
        ->where('rentals.isDeleted', '0')
        ->whereDate('rentals.dateTimeStart', '<=' , $datetime)
        ->whereDate('rentals.dateTimeEnd', '>' , $datetime)
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        ->get();

        return view('Owner/rentals.index', ['rentals' => $rental], ['title' => 'View Starting rentals']);
    }

    public function indexRentalPast()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $dt = Carbon::now()->setTimezone('Africa/Nairobi'); //Gets the current date
        $datetime = $dt->toDateTimeString(); 
        
        $rental = Rentals::
        where('rentals.inspectionStatus', 'accepted')
        ->where('rentals.OwnerStatus', 'accepted')
        ->where('rentals.isDeleted', '0')
        ->whereDate('rentals.dateTimeStart', '<' , $datetime)
        ->whereDate('rentals.dateTimeEnd', '<=' , $datetime)
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        ->get();

        return view('Owner/rentals.index', ['rentals' => $rental], ['title' => 'View Starting rentals']);
    }
}
