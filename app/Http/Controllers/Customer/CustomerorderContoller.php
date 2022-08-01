<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Orders;
use App\Models\Rentals;
use App\Models\Wallet;
use App\Models\Equipmentlisting;
use Carbon\Carbon;

class CustomerorderContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexWaiting()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        $order = Orders::
        where('isDeleted', 0)
        ->where('customerID', $customerID)
        ->where('paymentStatus', 0)
        ->where('isApproved', 0)
        ->get();
        return view('Customer/orders.index', ['orders' => $order], ['title' => 'View Orders Awaiting rental Acceptance or Rejection']);
    }

    public function indexPending()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        $order = Orders::
        where('isDeleted', 0)
        ->where('customerID', $customerID)
        ->where('paymentStatus', 0)
        ->where('amount', '!=', 0)
        ->where('isApproved', 1)
        ->get();
        return view('Customer/orders.index', ['orders' => $order], ['title' => 'View Orders Awaiting rental Acceptance or Rejection']);
    }

    public function indexRejected()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        $order = Orders::
        where('isDeleted', 0)
        ->where('customerID', $customerID)
        ->where('paymentStatus', 0)
        ->where('amount', 0)
        ->where('isApproved', 1)
        ->get();
        return view('Customer/orders.index', ['orders' => $order], ['title' => 'View Orders with all rejected rentals']);
    }

    public function indexPaid()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        $order = Orders::
        where('isDeleted', 0)
        ->where('customerID', $customerID)
        ->where('paymentStatus', 1)
        ->get();
        return view('Customer/orders.index', ['orders' => $order], ['title' => 'View Paid Orders']);
    }
    
    public function showOrder($orderID)
    {
        $order = Orders::findOrFail($orderID); //Find the record in the db of this id
        $paymentStatus = $order->paymentStatus;
        if($paymentStatus == 0) //If order isnt paid for, show all accepted and rejected rentals
        {
            $rental = Rentals::
            where('Rentals.isDeleted', '0')
            ->where('Rentals.orderID', $orderID)
            ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
            ->get();
        }
        else //Order is paid for, thus only show fully accepted rentals
        {
            $rental = Rentals::
            where('Rentals.isDeleted', '0')
            ->where('Rentals.orderID', $orderID)
            ->where('Rentals.inspectionStatus', 'accepted')
            ->where('Rentals.ownerStatus', 'accepted')
            ->join('equipmentlistings', 'equipmentlistings.equipmentID', "=", 'rentals.equipmentID')
            ->get();
        }
        
        return view('Customer/orders.show', ['order' => $order], ['rentals' => $rental]);
    }

    public function payOrder($orderID, $amount)
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID
        //Check if user has a wallet
        $wallet = Wallet::
        where('customerID', $customerID)
        ->where('isDeleted', 0)
        ->pluck('walletID');
        //If user has a wallet, check amount to pay- else redirect him to create a wallet
        if(isset($wallet[0]))
        {
            $walletID = $wallet[0];
            $wallet = Wallet::findOrFail($walletID);
            $walletAmount = $wallet -> amountAvailable;
            if($amount <= $walletAmount) //If the amount to be paid is less than or equal to the wallet amount, they can proceed to pay
            {
                //Remove amount from wallet
                $newWalletAmount = $walletAmount - $amount;
                $wallet -> amountAvailable = $newWalletAmount;
                $wallet->save();

                //Change IsPaid status of order
                $order = Orders::findOrFail($orderID);
                $order->paymentStatus = 1;
                $order->save();
                return redirect('/Customer/orders/paid')->with('msg', 'Amount Paid successfully. Plan collection with Equipment Owners accordingly ');
            }
            else
            {
                return redirect('/Customer/wallet')->with('msg', 'Insufficient funds! Add enough money to your wallet to pay for this order');
            }

        }
        else
        {
            return redirect('/Customer/wallet/create')->with('msg', 'Create your Online Wallet in order to make a purchase');
        }
    }

    public function createWallet()
    {
        return view('Customer/wallet.create_wallet');
    }

    public function addWallet()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        $wallet = new Wallet();
        $wallet -> customerID = $customerID;
        $wallet -> amountAvailable = request('amount');
        $wallet->save();
        return redirect('/Customer/wallet')->with('msg','Wallet created successfuly');

    }

    public function viewWallet()
    {
        $user = auth()->user();
        $customerID = $user->id; //Gets signed in user ID

        //Check if user has a wallet
        $wallet = Wallet::
        where('customerID', $customerID)
        ->where('isDeleted', 0)
        ->pluck('walletID');
        //If user has a wallet, update amount - else redirect him to create a wallet
        if(isset($wallet[0]))
        {
            $walletID = $wallet[0];
            $wallet1 = Wallet::findOrFail($walletID);
            return view('Customer/wallet.index_wallet', ['wallet' => $wallet1]);
        }
        else
        {
            return redirect('/Customer/wallet/create');
        }
        
        

    }

    public function updateWallet()
    {

        $walletID = request('walletID');

        $wallet = Wallet::findOrFail($walletID);
        $deposit = request('amount');
        $amount = $wallet -> amountAvailable;
        $newAmount = $amount + $deposit;
        $wallet -> amountAvailable = $newAmount;
        $wallet->save();
        return redirect('/Customer/wallet')->with('msg','Wallet updated successfuly');
    }
}
