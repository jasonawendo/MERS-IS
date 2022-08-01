<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inspectionjobs;
use App\Models\Inspectiontasks;
use App\Models\Users;
use Carbon\Carbon;

class OwnerinspectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexUpcomingListingRequestTasks()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $task = Inspectiontasks::
        where('inspectiontasks.isDeleted', 0)
        ->whereNull('inspectiontasks.rentalID') //temporary
        ->whereNotNull('inspectiontasks.IJID')

        //Join Inspection tasks and Equipment table to know the particular equipment that is being checked
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'inspectiontasks.equipmentID')
        
        ->where('equipmentlistings.ownerID', $ownerID) //The equipment being checked must belong to the specific logged in Owner

        //Join Inspection tasks and Inspection jobs table to know the Inspection job each task belongs to.
        ->join('inspectionjobs', 'inspectiontasks.IJID', "=", 'inspectionjobs.IJID')
        ->where(function($query) 
        {
            $dt = Carbon::now()->setTimezone('Africa/Nairobi');
            $date = $dt->toDateTimeString(); //Gets the current date
            $query
            ->whereDate('inspectionjobs.dateTimeInspection', '>=' , $date) //Meaning inspection datetime hasn't reached
            ->orWhere('inspectiontasks.isCompleted', 0); //Meaning task is incompleted
        })
        ->get();

        return view('Owner/inspection.index_listing_request_tasks', 
        ['tasks' => $task], 
        ['title' => 'These are Inspection tasks for your Equipment listing requests you should expect the Quality Inspector to undertake']);
        
    }

    public function indexUpcomingRentalRequestTasks()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $task = Inspectiontasks::
        where('inspectiontasks.isDeleted', 0)
        ->whereNull('inspectiontasks.equipmentID')
        ->whereNotNull('inspectiontasks.IJID')

        //Join Rentals and Inspection tasks table to know which tasks are for which rentals
        ->join('rentals', 'inspectiontasks.rentalID', "=", 'rentals.rentalID')
        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        
         //Join Inspection tasks and Inspection jobs table to know the Inspection job each task belongs to.
        ->join('inspectionjobs', 'inspectiontasks.IJID', "=", 'inspectionjobs.IJID')
        ->where(function($query) 
        {
            $dt = Carbon::now()->setTimezone('Africa/Nairobi');
            $date = $dt->toDateTimeString(); //Gets the current date
            $query
            ->whereDate('inspectionjobs.dateTimeInspection', '>=' , $date) //Meaning inspection datetime hasn't reached
            ->orWhere('inspectiontasks.isCompleted', 0);//Meaning task is incompleted
        })
        ->get();

        return view('Owner/inspection.index_rental_request_tasks',
        ['tasks' => $task],
        ['title' => 'These are Inspection tasks for Rental requests you should expect the Quality Inspector to undertake']);
        
    }

    public function indexCompletedListingRequestTasks()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of logged in Owner

        $task = Inspectiontasks::
        where('inspectiontasks.isDeleted', 0)
        ->whereNull('inspectiontasks.rentalID')
        ->whereNotNull('inspectiontasks.IJID')

        //Join Inspection tasks and Equipment table to know the particular equipment that is being checked
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'inspectiontasks.equipmentID') 
        
        ->where('equipmentlistings.ownerID', $ownerID) //The equipment being checked must belong to the specific logged in Owner
        
        //Join Inspection tasks and Inspection jobs table to know the Inspection job each task belongs to.
        ->join('inspectionjobs', 'inspectiontasks.IJID', "=", 'inspectionjobs.IJID') 
        ->where(function($query) 
        {
            $dt = Carbon::now()->setTimezone('Africa/Nairobi');
            $date = $dt->toDateTimeString(); //Gets the current date
            $query
            ->whereDate('inspectionjobs.dateTimeInspection', '<=' , $date) //Meaning inspection datetime has passed
            ->where('inspectiontasks.isCompleted', 1); //Meaning task is completed
        })
        ->get();

        return view('Owner/inspection.index_listing_request_tasks',
        ['tasks' => $task],
        ['title' => 'These are Inspection tasks for your Equipment listing requests that have been done']);
        
    }

    public function indexCompletedRentalRequestTasks()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $task = Inspectiontasks::
        where('inspectiontasks.isDeleted', 0)
        ->whereNull('inspectiontasks.equipmentID') 
        ->whereNotNull('inspectiontasks.IJID')

         //Join Rentals and Inspection tasks table to know which tasks are for which rentals
        ->join('rentals', 'inspectiontasks.rentalID', "=", 'rentals.rentalID')
        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner

        ->join('inspectionjobs', 'inspectiontasks.IJID', "=", 'inspectionjobs.IJID')
        ->where(function($query) 
        {
            $dt = Carbon::now()->setTimezone('Africa/Nairobi');
            $date = $dt->toDateTimeString(); //Gets the current date
            $query
            ->whereDate('inspectionjobs.dateTimeInspection', '<=' , $date)//Meaning inspection datetime has passed
            ->where('inspectiontasks.isCompleted', 1);//Meaning task is completed
        })
        ->get();

        return view('Owner/inspection.index_rental_request_tasks',
        ['tasks' => $task],
        ['title' => 'These are Inspection tasks for Rental requests that have been done']);
        
    }


    public function showInspector($inspectorID)
    {
        $user = Users::findOrFail($inspectorID); //Find the record in the db of this id
        return view('Owner/inspection.show_inspector', ['user' => $user]);
    }
}


