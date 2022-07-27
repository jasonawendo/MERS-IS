<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipmentlisting;
use App\Models\Inspectiontasks;

class OwnerlistingController extends Controller
{
    public function indexAccepted()
    {
         $user = auth()->user();
         $ownerID = $user->id; //Gets Owner ID of signed in Owner

        // $equipment = Equipmentlisting::all();
        $equipment = Equipmentlisting::
        where('ownerID', $ownerID)
        ->where('status', 'accepted')
        ->where('isDeleted', '0')
        ->get(); //where status is accepted and isDeleted=0
        return view('Owner/equipmentlistings.index', ['equipmentlisting' => $equipment], ['title' => 'View my Equipment listings']);
    }

    public function indexPending()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $equipment = Equipmentlisting::
        where('ownerID', $ownerID)
        ->where('status', 'pending')
        ->where('isDeleted', '0')
        ->get();
        return view('Owner/equipmentlistings.index', ['equipmentlisting' => $equipment], ['title' => 'View my Equipment listing requests']);
    }

    public function indexRejected()
    {
        // $equipment = Equipmentlisting::all();
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $equipment = Equipmentlisting::
        where('ownerID', $ownerID)
        ->where('status', 'rejected')
        ->get(); //where status is rejected and isDeleted=0
        return view('Owner/equipmentlistings.index', ['equipmentlisting' => $equipment], ['title' => 'View my rejected equipment listing requests']);
    }

    public function indexRemoved()
    {
        // $equipment = Equipmentlisting::all();
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $equipment = Equipmentlisting::
        where('ownerID', $ownerID)
        ->where('status', 'accepted')
        ->where('isDeleted', '1')
        ->get(); //where status is rejected and isDeleted=0
        return view('Owner/equipmentlistings.index', ['equipmentlisting' => $equipment], ['title' => 'View my removed equipment listings']);
    }

    public function create()
    {
        return view('Owner/equipmentlistings.create_listing');
    }

    public function store()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $newImageName = time(). '-' . $ownerID . '-' . request('name') . '.' . request('equipmentimg')->extension(); //renames the image based on time uploaded, firstname, lastname of user and extension of the image
        request('equipmentimg')->move(public_path('img'), $newImageName); //Moves uploaded file image into the public image folder

        $status = "pending"; //When it is an equipment listing request before it becomes an actual equipment listing

        $equipment = new Equipmentlisting();
        $equipment->ownerID = $ownerID;
        $equipment->equipmentName = request('name');
        $equipment->equipmentDescription = request('description');
        $equipment->rentRate = request('rate');
        $equipment->address = request('address');
        $equipment->status = $status;
        $equipment->equipmentAvailability= 1; //By default, equipment should be available
        $equipment->equipmentImage = $newImageName;
        $equipment->save();

        $equipmentID = $equipment->equipmentID; //This is the ID of the equipment that has just been created
        //When a listing request is made, it immediately becomes an Inspection task.
        $description = "Check equipment for equipment listing request";
        $task = new Inspectiontasks();
        $task->taskDescription = $description;
        $task->address = request('address');
        $task->equipmentID = $equipmentID;
        $task->save();
        return redirect('/Owner/equipmentlistings/pending')->with('msg','Equipment listing request submitted successfully'); 
    }


    public function show($equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        return view('Owner/equipmentlistings.show', ['equipment' => $equipment]);
    }

    public function destroy($equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        $equipment->isDeleted = request('isDeleted');
        $equipment->save();
        return redirect('/Owner/equipmentlistings')->with('msg','Equipmnet Listing has been removed succesfully');

        // error_log(request('isDeleted'));
    }

    public function edit($equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        return view('Owner/equipmentlistings.edit_listing', ['equipment' => $equipment]);
    }

    public function updateListing($equipmentID)
    {
        $img = request('equipmentimg');
        $ownerID = request('ownerID');

        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id

        if(isset($img))
        {
            $newImageName = time(). '-' . $ownerID . '-' . request('name') . '.' . request('equipmentimg')->extension(); //renames the image based on time uploaded, firstname, lastname of user and extension of the image
            request('equipmentimg')->move(public_path('img'), $newImageName); //Moves uploaded file image into the public image folder
            $equipment->equipmentImage = $newImageName;
        }
        $equipment->equipmentName = request('name');
        $equipment->equipmentDescription = request('description');
        $equipment->rentRate = request('rate');
        $equipment->address = request('address');
        
        // error_log($equipment);
        $equipment->save();
        return redirect("/Owner/equipmentlistings/$equipmentID")->with('msg','Equipment listing information has been updated successfully');
    }

    public function changeAvailability($equipmentID, $availableStatus)
    {
        //Changes Equipment availability to either 0 or 1
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        $equipment->equipmentAvailability = $availableStatus; 
        $equipment->save();

        return redirect("/Owner/equipmentlistings/$equipmentID")->with('msg','Equipment Availability has been updated successfully');
    }
}
