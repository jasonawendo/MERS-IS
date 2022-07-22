<?php

namespace App\Http\Controllers\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Inspectionjobs;
use App\Models\Inspectiontasks;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Auth;

class Inspectordashboard extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $inspectorID = $user->id; //Gets Inspector ID of signed in inspector

        $dt = Carbon::now();
        $date = $dt->toDateTimeString(); //Gets the current date

        $pastjob = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID', $inspectorID)
        ->where('isCompleted', 1)
        ->whereDate('dateTimeInspection', '<' , $date)
        ->count();

        $pendingjob = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID', $inspectorID)
        ->where('isCompleted', 0)
        ->whereDate('dateTimeInspection', '<=' , $date)
        ->count();

        $assignedjob = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID', $inspectorID)
        ->where('isCompleted', 0)
        ->whereDate('dateTimeInspection', '>' , $date)
        ->count();

        $incompletejob = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID', $inspectorID)
        ->where('isCompleted', 0)
        ->count();

        $completejob = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID', $inspectorID)
        ->where('isCompleted', 1)
        ->count();

        return view('Inspector/dashboard')
        ->with('pastjob', $pastjob)
        ->with('pendingjob', $pendingjob)
        ->with('assignedjob', $assignedjob)
        
        ->with('incompletejob', $incompletejob)
        ->with('completejob', $completejob);
        

    }
}
