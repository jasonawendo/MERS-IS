<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipmentlisting; //Links the Equipmentlisting Model for us to use inside the controller

class EquipmentlistingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('Customer.home');
    }

    public function search()
    {
        $search = request('search');
        $equipment = Equipmentlisting::
        where('status', 'accepted')
        ->where('isDeleted', '0')
        ->where('equipmentName', 'LIKE', '%'.$search.'%')->get(); //Search query
        return view('Customer/equipmentlistings.index', ['equipmentlisting' => $equipment])
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
        return view('Customer/equipmentlistings.index', ['equipmentlisting' => $equipment])
        ->with('msg',"Explore all the equipment listing verified, checked and offered on our platform. Ensure you have an account before you can rent.");
        
    }

    public function show($equipmentID)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id
        return view('Customer/equipmentlistings.show', ['equipment' => $equipment]);
    }

    // public function showOwner($userID)
    // {
    //     $user = Users::findOrFail($userID); //Find the record in the db of this id
    //     return view('Customer/rr.show_owner', ['user' => $user]);
    // }
}
