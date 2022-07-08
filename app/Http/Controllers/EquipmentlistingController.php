<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipmentlisting; //Links the Equipmentlisting Model for us to use inside the controller

class EquipmentlistingController extends Controller
{
    public function index()
    {
        $equipment = Equipmentlisting::all();
        // $equipment = Equipmentlisting::where('status', 'accepted')->where('isDeleted', '0') ->get(); //where status is accepted and isDeleted=0
        return view('equipmentlistings.index', ['equipmentlisting' => $equipment]);
    }

    public function show($equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        return view('equipmentlistings.show', ['equipment' => $equipment]);
    }
}
