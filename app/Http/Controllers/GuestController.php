<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipmentlisting; //Links the Equipmentlisting Model for us to use inside the controller

class GuestController extends Controller
{
    public function search()
    {
        $search = request('search');
        $equipment = Equipmentlisting::
        where('status', 'accepted')
        ->where('isDeleted', '0')
        ->where('equipmentName', 'LIKE', '%'.$search.'%')->get(); //Search query
        return view('equipmentlistings.index', ['equipmentlisting' => $equipment])
            ->with('equipmentlisting', $equipment)
            ->with('msg',"Results of '$search'");
    }

    public function index()
    {
        // $equipment = Equipmentlisting::all();
        $equipment = Equipmentlisting::
        where('status', 'accepted')
        ->where('isDeleted', '0')
        ->get(); //where status is accepted and isDeleted=0
        return view('equipmentlistings.index', ['equipmentlisting' => $equipment])
        ->with('msg',"Explore all the equipment listing verified, checked and offered on our platform. Ensure you have an account before you can rent.");
        
    }

    public function show($equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        return view('equipmentlistings.show', ['equipment' => $equipment]);
    }
}
