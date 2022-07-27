<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rrcustomers;
use App\Models\Rrowners;
use App\Models\Users;
use App\Models\Rentals;
use App\Models\Equipmentlisting;
use Carbon\Carbon;

class OwnerrrController extends Controller
{
    public function indexRRCustomers()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $rr = Rrcustomers::
        where('rrcustomers.isDeleted', '0')
        ->where('rrcustomers.ownerID', $ownerID)
        //Join Rentals and Inspection tasks table to know which tasks are for which rentals
        ->join('rentals', 'rrcustomers.rentalID', "=", 'rentals.rentalID')
        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        //Joing Rentals and users table to know the customer being referred to in the rentals table
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->get();
        return view('Owner/rr.index_customer', ['rrs' => $rr]);
    }

    public function indexRRPendingCustomers()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner
        $dt = Carbon::now()->setTimezone('Africa/Nairobi');
        $date = $dt->toDateTimeString(); //Gets the current date

        $rental = Rentals::
        where('rentals.inspectionStatus', 'accepted')
        ->where('rentals.ownerStatus', 'accepted')
        ->whereDate('rentals.dateTimeEnd', '<' , $date)
        ->where('rentals.isDeleted', '0')
        ->where('rentals.isRated', '0') //New field. If rated, dont display.

        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->where('equipmentlistings.ownerID', $ownerID)//The equipment being checked must belong to the specific logged in Owner
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->get();

        return view('Owner/rr.index_pendingrr', ['rentals' => $rental]);
    }

    public function indexMyRR()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $rr = Rrowners::
        where('rrowners.isDeleted', '0')
        ->where('rrowners.ownerID', $ownerID)
        //Join Rentals and Inspection tasks table to know which tasks are for which rentals
        ->join('rentals', 'rrowners.rentalID', "=", 'rentals.rentalID')
        //Join Rentals and Equipment table to know which equipment and their owners are for which rentals
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        //Joing Rentals and users table to know the customer being referred to in the rentals table
        ->join('users', 'rentals.customerID', "=", 'users.id')
        ->get();
        return view('Owner/rr.index_ownerrr', ['rrs' => $rr]);
    }

    public function showCustomers($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        $rr = Rrcustomers::
        where('rrcustomers.isDeleted', '0')
        ->where('rrcustomers.customerID', $userID)
        ->join('users', 'rrcustomers.ownerID', "=", 'users.id')
        ->get();
        return view('Owner/rr.show_customer', ['user' => $user], ['rrs' => $rr]);
    }

    public function createRR($userID, $rentalID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id

        return view('Owner/rr.create_rr', ['user' => $user], ['rentalID' => $rentalID]);
    }

    public function saveRR()
    {
        $user = auth()->user();
        $ownerID = $user->id; //Gets Owner ID of signed in Owner

        $rentalID = request('rentalID');
        $customerID = request('customerID');
        $rating = request('rating');

        //Add RR to db
        $rr = new RRcustomers();
        $rr->customerID = $customerID;
        $rr->ownerID = $ownerID;
        $rr->rating = $rating;
        $rr->review = request('review');
        $rr->rentalID = $rentalID;
        $rr->save();

        //Rental Is Rated
        $rental = Rentals::findOrFail($rentalID); //Find the record in the db of this id
        $rental->isRated = 1;
        $rental->save();

        //Update User rating
        $user = Users::findOrFail($customerID); //Find the record in the db of this id
        $previousRating = $user->averageRating;
        $newRating = ($previousRating + $rating) / 2;
        $averageRating = round($newRating); //Rounds off number
        $user->averageRating = $averageRating;
        $user->save();

        return redirect('/Owner/customers/ratingsreviews')->with('msg','Customer rate and review submitted successfully');
    }
}
