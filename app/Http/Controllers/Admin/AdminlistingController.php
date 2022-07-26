<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipmentlisting; //Links the Equipmentlisting Model for us to use inside the controller

class AdminlistingController extends Controller
{
    public function indexAccepted()
    {
        // return DB::table('users')
        // ->where('role', 'Equipment Owner')
        // ->join('equipmentlistings', 'users.id', "=", 'equipmentlistings.ownerID')
        // ->select('users.id', 'users.fname', 'equipmentlistings.equipmentID' )
        // ->get(); 

        // $equipment = DB::table('equipmentlistings')

        // ->join('users', 'users.id', "=", 'equipmentlistings.ownerID')
        // ->select('users.id', 'users.fname', 'equipmentlistings.equipmentID' )

        
        $equipment = Equipmentlisting::
        where('equipmentlistings.status', 'accepted')
        ->where('equipmentlistings.isDeleted', '0')
        ->join('users', 'users.id', "=", 'equipmentlistings.ownerID')
        ->get(); //where status is accepted and isDeleted=0
        return view('Admin/equipmentlistings.index', ['equipmentlisting' => $equipment], ['title' => 'View Equipment listing']);
    }

    public function indexPending()
    {
        // $equipment = Equipmentlisting::all();
        $equipment = Equipmentlisting::
        where('equipmentlistings.status', 'pending')
        ->where('equipmentlistings.isDeleted', '0')
        ->join('users', 'users.id', "=", 'equipmentlistings.ownerID')
        ->get();
        return view('Admin/equipmentlistings.index', ['equipmentlisting' => $equipment], ['title' => 'View Equipment listing request']);
    }

    public function indexRejected()
    {
        // $equipment = Equipmentlisting::all();
        $equipment = Equipmentlisting::
        where('equipmentlistings.status', 'rejected')
        ->where('equipmentlistings.isDeleted', '0')
        ->join('users', 'users.id', "=", 'equipmentlistings.ownerID')
        ->get(); //where status is rejected and isDeleted=0
        return view('Admin/equipmentlistings.index', ['equipmentlisting' => $equipment], ['title' => 'View rejected equipment listing request']);
    }

    public function show($equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        return view('Admin/equipmentlistings.show', ['equipment' => $equipment]);
    }

    public function destroy($equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        $equipment->isDeleted = request('isDeleted');
        $equipment->save();
        return redirect('/Admin/equipmentlistings')->with('msg','Equipmnet Listing has been removed succesfully');

        // error_log(request('isDeleted'));
    }
}






