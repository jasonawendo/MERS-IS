<?php

namespace App\Http\Controllers\Inspector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Equipmentlisting;
use App\Models\Inspectionjobs;
use App\Models\Inspectiontasks;
use App\Models\Rentals;
use Carbon\Carbon;

class InspectorjobController extends Controller
{
    public function indexPastJobs()
    {
        $user = auth()->user();
        $inspectorID = $user->id; //Gets Inspector ID of signed in inspector

        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateTimeString(); //Gets the current date

        $job = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID', $inspectorID)
        ->where('isCompleted', 1)
        ->whereDate('dateTimeInspection', '<' , $date)
        ->get();
        return view('Inspector/jobs.index_jobs', ['jobs' => $job], ['title' => 'Your previous Inspection jobs']);
    }

    public function indexPendingJobs()
    {
        $user = auth()->user();
        $inspectorID = $user->id; //Gets Inspector ID of signed in inspector

        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateTimeString(); //Gets the current date

        $job = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID', $inspectorID)
        ->where('isCompleted', 0)
        ->whereDate('dateTimeInspection', '<=' , $date)
        ->get();
        return view('Inspector/jobs.index_jobs', ['jobs' => $job], ['title' => 'Your pending Inspection jobs']);
    }

    public function indexAssignedJobs()
    {
        $user = auth()->user();
        $inspectorID = $user->id; //Gets Inspector ID of signed in inspector

        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateTimeString(); //Gets the current date

        $job = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID', $inspectorID)
        ->where('isCompleted', 0)
        ->whereDate('dateTimeInspection', '>' , $date)
        ->get();
        return view('Inspector/jobs.index_jobs', ['jobs' => $job], ['title' => 'Your next Inspection jobs']);
    }

    public function show($IJID)
    {
        $job = Inspectionjobs::findOrFail($IJID); //Find the record in the db of this id
        $task = Inspectiontasks::
        where('isDeleted', '0')
        ->where('IJID', $IJID)
        ->get();
        return view('Inspector/jobs.show_job', ['job' => $job], ['tasks' => $task]);
    }

    public function showRentalEquipment($IJID, $ITID, $rentalID)
    {
        $rental = Rentals::findOrFail($rentalID);
        $equipmentID = $rental->equipmentID;
        // dd($equipmentID);
        return redirect("/Inspectors/rental/$IJID/$ITID/$equipmentID");
    }

    public function showEquipment($IJID, $ITID, $equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id

        return view('Inspector/jobs.show_equipment', ['equipment' => $equipment], ['task' => $ITID]);
    }

    public function showUser($equipmentID, $ownerID)
    {
        $user = Users::findOrFail($ownerID); //Find the record in the db of this id
        return view('Inspector/jobs.show_user', ['user' => $user]);
    }

    public function add($IJID, $ITID, $equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID);
        return view('Inspector/jobs.add_eldetails')
        ->with('equipment', $equipment)
        ->with('task', $ITID)
        ->with('job', $IJID);
    }

    public function store($equipmentID)
    {
        // error_log($equipmentID);
        // error_log(request('task'));
        // error_log(request('condition'));
        // error_log(request('value'));
        // error_log(request('submit'));

        $IJID = request('job');
        //Set Inspection task isCompleted to 1
        $ITID = request('task');
        $task = Inspectiontasks::findOrFail($ITID);
        $task->isCompleted = 1;
        $task->save();

        $this->editJobStatusBasedOnITs($IJID); //Custom function used to check whether all the Inspection tasks 
        //of the given Inspection job have been complete. If that is so, the function will make the isCompleted status
        //of the given Inspection job to be completed

        $status = request('submit');
        if($status == "accept")
        {
            $status = "accepted";
        }
        else
        {
            $status = "rejected";
        }

        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        $equipment->status = $status;
        $equipment->equipmentValue = request('value');
        $equipment->equipmentCondition = request('condition');
        $equipment->save();
        return redirect("/Inspectors/jobs/$IJID")->with('msg','Inspection task has been completed and corresponding listing request has been updated');

    }

    public function acceptRental($IJID, $ITID, $rentalID)
    {
        //Set Inspection task isCompleted to 1
        $task = Inspectiontasks::findOrFail($ITID);
        $task->isCompleted = 1;
        $task->save();

        $this->editJobStatusBasedOnITs($IJID); //Custom function used to check whether all the Inspection tasks 
        //of the given Inspection job have been complete. If that is so, the function will make the isCompleted status
        //of the given Inspection job to be completed

        //Set Rental request of the given rentalID to accepted
        $rental = Rentals::findOrFail($rentalID);
        $rental->InspectionStatus= "accepted";
        $rental->save();

          return redirect("/Inspectors/jobs/$IJID")->with('msg','Inspection task has been completed and corresponding rental request has been approved');
        // error_log($IJID);
        // error_log($ITID);
        // error_log($rentalID);
    
    }

    public function rejectRental($IJID, $ITID, $rentalID)
    {
        //Set Inspection task isCompleted to 1
        $task = Inspectiontasks::findOrFail($ITID);
        $task->isCompleted = 1;
        $task->save();

        $this->editJobStatusBasedOnITs($IJID); //Custom function used to check whether all the Inspection tasks 
        //of the given Inspection job have been complete. If that is so, the function will make the isCompleted status
        //of the given Inspection job to be completed

        //Set Rental request of the given rentalID to accepted
        $rental = Rentals::findOrFail($rentalID);
        $rental->InspectionStatus= "rejected";
        $rental->save();

         return redirect("/Inspectors/jobs/$IJID")->with('msg','Inspection task has been completed and corresponding rental request has been rejected');
        // error_log($IJID);
        // error_log($ITID);
        // error_log($rentalID);
    
    }
}
