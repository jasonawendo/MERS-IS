<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rentals;
use Carbon\Carbon;

class AdminrentalController extends Controller
{
    public function index()
    {
        $rental = Rentals::
        where('rentals.inspectionStatus', 'pending')
        ->where('rentals.OwnerStatus', 'pending')
        ->where('rentals.isDeleted', '0')
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Rental Requests']);
    }

    public function indexRejects()
    {
        $rental = Rentals::
        where('rentals.isDeleted', '0')
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where(function($query) 
                {
                    $query
                    ->where('rentals.inspectionStatus', 'rejected')
                    ->orWhere('rentals.OwnerStatus', 'rejected');
                })
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Rejected Rental Requests']);
    }

    public function indexStart()
    {
        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateString(); //Gets the current date

        $rental = Rentals::
        where('rentals.isDeleted', '0')
        ->whereDate('rentals.dateTimeStart', '>' , $date)
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Starting rentals']);
    }

    public function indexOngoing()
    {
        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateString(); //Gets the current date

        $rental = Rentals::
        where('rentals.isDeleted', '0')
        ->whereDate('rentals.dateTimeStart', '<=' , $date)
        ->whereDate('rentals.dateTimeEnd', '>' , $date)
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Ongoing rentals']);
    }

    public function indexPast()
    {
        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateString(); //Gets the current date

        $rental = Rentals::
        where('rentals.isDeleted', '0')
        ->whereDate('rentals.dateTimeEnd', '<=' , $date)
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Past rentals']);
    }
}
