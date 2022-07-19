<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Rentals;
use Carbon\Carbon;

class AdminrentalController extends Controller
{
    public function index()
    {
        $rental = Rentals::
        where('inspectionStatus', 'pending')
        ->where('OwnerStatus', 'pending')
        ->where('isDeleted', '0')
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Rental Requests']);
    }

    public function indexRejects()
    {
        
        $rental = Rentals::
        where('isDeleted', '0')
        ->where(function($query) 
                {
                    $query
                    ->where('inspectionStatus', 'rejected')
                    ->orWhere('OwnerStatus', 'rejected');
                })
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Rejected Rental Requests']);
    }

    public function indexStart()
    {
        $dt = Carbon::now();
        $date = $dt->toDateString(); //Gets the current date

        $rental = Rentals::
        where('isDeleted', '0')
        ->whereDate('dateTimeStart', '>' , $date)
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Starting rentals']);
    }

    public function indexOngoing()
    {
        $dt = Carbon::now();
        $date = $dt->toDateString(); //Gets the current date

        $rental = Rentals::
        where('isDeleted', '0')
        ->whereDate('dateTimeStart', '<=' , $date)
        ->whereDate('dateTimeEnd', '>' , $date)
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Ongoing rentals']);
    }

    public function indexPast()
    {
        $dt = Carbon::now();
        $date = $dt->toDateString(); //Gets the current date

        $rental = Rentals::
        where('isDeleted', '0')
        ->whereDate('dateTimeEnd', '<=' , $date)
        ->get();

        return view('Admin/rentals.index', ['rentals' => $rental], ['title' => 'View Past rentals']);
    }
}
