<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Rentals;

class AdminorderController extends Controller
{
    public function indexPaid()
    {
        $order = Orders::
        where('paymentStatus', '1')
        ->where('isDeleted', '0')
        ->get();
        // return view('Admin/users.index');
        return view('Admin/orders.index', ['orders' => $order], ['title' => 'View Paid Orders']);
    }

    public function indexNotpaid()
    {
        $order = Orders::
        where('paymentStatus', '0')
        ->where('isDeleted', '0')
        ->get();
        // return view('Admin/users.index');
        return view('Admin/orders.index', ['orders' => $order], ['title' => 'View Paid Orders']);
    }

    public function show($orderID)
    {
        $order = Orders::findOrFail($orderID); //Find the record in the db of this id
        $rental = Rentals::
        where('isDeleted', '0')
        ->where('orderID', $orderID)
        ->get();
        return view('Admin/orders.show', ['order' => $order], ['rentals' => $rental]);
    }
}
