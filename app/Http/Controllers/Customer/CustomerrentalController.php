<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Orders;
use App\Models\Rentals;
use App\Models\Equipmentlisting;
use Carbon\Carbon;

class CustomerrentalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createRequest($equipmentID, $rentRate)
    {
        $equipment = Equipmentlisting::findOrFail($equipmentID); //Find the record in the db of this id

        return view('Customer/rental.create_rental', ['equipment' => $equipment], ['rate' => $rentRate]);
    }

    public function storeRequest()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        $rate = request('rate');
        $quantity = request('quantity');
        $start = request('startDateTime');
        $end = request('endDateTime');

        //Get number of days between start and end date
        $startDate = Carbon::create($start);
        $endDate = Carbon::create($end);
        $result = date_diff($startDate, $endDate);
        $days = $result->format('%d');

        $totalprice = $rate * $days * $quantity; //Calculcate price of a single rental

        $rental = new Rentals();
        $rental->customerID = $customerID;
        $rental->equipmentID = request('equipmentID');
        $rental->totalPrice = $totalprice;
        $rental->dateTimeStart = $start;
        $rental->dateTimeEnd = $end;
        $rental->quantity = $quantity;
        $rental->inspectionStatus = "pending";
        $rental->ownerStatus = "pending";
        $rental->save();

        return redirect('/Customer/rental/cart')->with('msg','Rental Request added to order successfully');
    }

    public function indexCart()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        $rental = Rentals::
        where('rentals.inspectionStatus', 'pending')
        ->where('rentals.OwnerStatus', 'pending')
        ->whereNull('rentals.orderID')
        ->where('rentals.isDeleted', '0')
        ->where('rentals.customerID', $customerID)
        ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
        ->get();

        $total = Rentals::
        where('inspectionStatus', 'pending')
        ->where('OwnerStatus', 'pending')
        ->whereNull('orderID')
        ->where('isDeleted', '0')
        ->where('customerID', $customerID)
        ->sum('totalPrice');
        
        return view('Customer/rental.cart', ['rentals' => $rental], ['total' => $total]);
    }

    public function deleteRequest($rentalID)
    {
        $rental = Rentals::findOrFail($rentalID); //Find the record in the db of this id
        $rental->isDeleted = 1;
        $rental->save();
        return redirect('/Customer/rental/cart')->with('msg','Rental Request removed successfully');
    }

    public function createOrder($amount)
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        //Create Order
        $order = new Orders();
        $order->customerID = $customerID;
        $order->amount = $amount;
        $order->save();
        $orderID = $order->orderID; //Gets order ID of just created order

        //Find the chosen rental requests
        $rentalArray = Rentals::
        where('inspectionStatus', 'pending')
        ->where('OwnerStatus', 'pending')
        ->whereNull('orderID')
        ->where('isDeleted', '0')
        ->where('customerID', $customerID)
        ->pluck('rentalID');

        //Assign each chosen rental to the new created order
        $length = count($rentalArray);
        for ($i=0; $i < $length; $i++) 
        { 
            $rental = Rentals::findOrFail( $rentalArray[$i] );
            $rental->orderID = $orderID;
            $rental->save();
        }

        return redirect('/Customer/orders/waiting')
        ->with('msg', 'Order created successfully');


    }
}
