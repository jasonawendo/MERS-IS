<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;
use App\Models\Inspectionjobs;
use App\Models\Inspectiontasks;

class AdmininspectorController extends Controller
{
    public function indexInspectors()
    {
        $inspector = Users::
        where('role', 'Quality Inspector')
        ->where('isDeleted', '0')
        ->get();

        return view('Admin/inspectors.index_inspectors', ['inspectors' => $inspector]);
        
        //return view('Admin/inspectors.index_inspectors', ['inspector' => $inspector]);
    }

    public function remove($userID)
    {
        $this->removeUser($userID);
        return redirect('/Admin/inspectors/inspectors')->with('msg','Quality Inspector has been removed succesfully');

        // error_log(request('isDeleted'));
    }

    public function indexJobs()
    {
        $job = Inspectionjobs::
        where('Inspectionjobs.isDeleted', '0')
        ->join('users', 'Inspectionjobs.inspectorID', "=", 'users.id')
        ->get();
        return view('Admin/inspectors.index_jobs', ['jobs' => $job]);
    }

    public function showInspectorJobs($userID)
    {
        $job = Inspectionjobs::
        where('isDeleted', '0')
        ->where('inspectorID' , $userID) //Gets jobs where the ID is for a specific quality inspector
        ->get();
        return view('Admin/inspectors.index_jobs', ['jobs' => $job]);
    }

    public function indexUnassignedTasks()
    {
        $task = Inspectiontasks::
        where('isDeleted', '0')
        ->whereNull('IJID')
        ->get();

        return view('Admin/inspectors.index_untasks', ['tasks' => $task]);
        
    }

    public function show($IJID)
    {
        $job = Inspectionjobs::findOrFail($IJID); //Find the record in the db of this id
        $task = Inspectiontasks::
        where('isDeleted', '0')
        ->where('IJID', $IJID)
        ->get();
        return view('Admin/inspectors.show_job', ['job' => $job], ['tasks' => $task]);
    }

    public function createJob()
    {
        $inspector = Users::
        where('role', 'Quality Inspector')
        ->where('isDeleted', '0')
        ->get();

        $task = Inspectiontasks::
        where('isDeleted', '0')
        ->whereNull('IJID')
        ->get();

        return view('Admin/inspectors.create_job', ['inspectors' => $inspector], ['tasks' => $task]);
    }

    public function storeJob()
    {
        // error_log(request('inspectorID'));
        // error_log(request('inspectionDateTime'));
        // error_log(request('address'));
        $jobs = new Inspectionjobs();
        $jobs->inspectorID = request('inspectorID');
        $jobs->dateTimeInspection = request('inspectionDateTime');
        $jobs->address = request('address');

        // error_log($jobs);
        $jobs->save();
        return redirect('/Admin/inspectors/jobs')->with('msg','New Inspection Job has been created. Assign tasks to it');

    }

    public function createInspector()
    {
        return view('Admin/inspectors.create_inspector');
    }

    public function storeInspector()
    {
        $newImageName = time(). '-' . request('fname') . request('lname') . '.' . request('profile')->extension(); //renames the image based on time uploaded, firstname, lastname of user and extension of the image
        $role = "Quality Inspector";
        request('profile')->move(public_path('img'), $newImageName); //Moves uploaded file image into the public image folder

        //Encrypting q.inspector password
        $password = request('password');
        $encryptedPassword = Hash::make($password);

        $inspector = new Users();
        $inspector->fname = request('fname');
        $inspector->lname = request('lname');
        $inspector->email = request('email');
        $inspector->password = $encryptedPassword;
        $inspector->mobilenumber = request('mobilenumber');
        $inspector->krapin = request('krapin');
        $inspector->address = request('address');
        $inspector->role = $role;
        $inspector->nationalid = request('nationalid');
        $inspector->profilepic = $newImageName;



        // error_log($inspector);
        $inspector->save();
        return redirect('/Admin/inspectors/inspectors')->with('msg','New Quality Inspector added successfully');


        
    }

    public function assignTasks($IJID)
    {
        $job = Inspectionjobs::findOrFail($IJID); //Find the record in the db of this id
        $task = Inspectiontasks::
        where('isDeleted', '0')
        ->whereNull('IJID')
        ->get();

        return view('Admin/inspectors.assigntasks',  ['job' => $job], ['tasks' => $task]);
    }

    public function assign(Request $request)
    {
        $IJID = request('job');

        // Assign the Inspection Job to the selected Inspection tasks
        $array = request('task');
        if (!isset($array)) 
        {
            return redirect('/Admin/inspectors/jobs')->with('msg','No tasks were selected');
            die;
        }

        else
        {
            $length = count($array);
            for ($i=0; $i < $length; $i++) 
            { 
                $task = Inspectiontasks::findOrFail( $array[$i] );
                $task->IJID = $IJID;
                $task->save();
            }

        // Change Updated at date-time for this Inspection Job
            $time = date('Y-m-d H:i:s');
            $job = Inspectionjobs::findOrFail($IJID);
            $job->updated_at = $time;
            $job->save();
        }
        

       

        return redirect('/Admin/inspectors/jobs')->with('msg','Tasks assigned successfully');
    }
}
