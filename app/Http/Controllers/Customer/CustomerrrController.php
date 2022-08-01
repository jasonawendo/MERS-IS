<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rrcustomers;
use App\Models\Rrowners;
use App\Models\Users;
use App\Models\Rentals;
use App\Models\Equipmentlisting;
use Carbon\Carbon;

class CustomerrrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexRROwners()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets Owner ID of signed in Owner

        $rr = Rrowners::
        where('rrowners.isDeleted', '0')
        ->where('rrowners.customerID', $customerID)
        //Join Rentals and Inspection tasks table to know which tasks are for which rentals
        ->join('rentals', 'rrowners.rentalID', "=", 'rentals.rentalID')
        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        //Join Equipment and users table to know the owner being referred to in the equipmentlisting table
        ->join('users', 'equipmentlistings.ownerID', "=", 'users.id')
        ->get();
        return view('Customer/rr.index_owner', ['rrs' => $rr]);
    }

    public function indexRRPendingOwners()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets Owner ID of signed in Owner
        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateTimeString(); //Gets the current date

        $rental = Rentals::
        where('rentals.inspectionStatus', 'accepted')
        ->where('rentals.ownerStatus', 'accepted')
        ->whereDate('rentals.dateTimeEnd', '<' , $date)
        ->where('rentals.isDeleted', '0')
        ->where('rentals.isRated', '0') //New field. If rated, dont display.
        ->where('rentals.customerID', $customerID)
        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->join('users', 'users.id', "=", 'equipmentlistings.ownerID')
        
        ->get();

        return view('Customer/rr.index_pendingrr', ['rentals' => $rental]);
    }

    public function indexMyRR()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets Owner ID of signed in Owner

        $rr = Rrcustomers::
        where('rrcustomers.isDeleted', '0')
        ->where('rrcustomers.customerID', $customerID)
        //Join Rentals and Inspection tasks table to know which tasks are for which rentals
        ->join('rentals', 'rrcustomers.rentalID', "=", 'rentals.rentalID')
        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        //Join Equipment and users table to know the owner being referred to in the equipmentlisting table
        ->join('users', 'equipmentlistings.ownerID', "=", 'users.id')
        ->get();
        return view('Customer/rr.index_customerrr', ['rrs' => $rr]);
    }

    public function showOwners($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        $rr = Rrowners::
        where('rrowners.isDeleted', '0')
        ->where('rrowners.ownerID', $userID)
        ->join('users', 'rrowners.customerID', "=", 'users.id')
        ->get();
        return view('Customer/rr.show_owner', ['user' => $user], ['rrs' => $rr]);
    }

    public function createRR($userID, $rentalID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id

        return view('Customer/rr.create_rr', ['user' => $user], ['rentalID' => $rentalID]);
    }

    public function saveRR()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets Customer ID of signed in Owner

        $rentalID = request('rentalID');
        $ownerID = request('ownerID');
        $rating = request('rating');

        //Add RR to db
        $rr = new RRowners();
        $rr->ownerID = $ownerID;
        $rr->customerID = $customerID;
        $rr->rating = $rating;
        $rr->review = request('review');
        $rr->rentalID = $rentalID;
        $rr->save();


        //Update User rating
        $user = Users::findOrFail($ownerID); //Find the record in the db of this id
        $previousRating = $user->averageRating;
        $newRating = ($previousRating + $rating) / 2;
        $averageRating = round($newRating); //Rounds off number
        $user->averageRating = $averageRating;
        $user->save();

        return redirect('/Customer/owners/ratingsreviews')->with('msg','Owner rate and review submitted successfully');
    }
}
