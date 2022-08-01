<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Users;
use App\Models\Inspectionjobs;
use App\Models\Inspectiontasks;
use App\Models\Equipmentlisting;
use App\Models\Orders;
use App\Models\Rrcustomers;
use App\Models\Rrowners;
use App\Models\Rentals;
use Illuminate\Support\Facades\Hash;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function editJobStatusBasedOnITs($IJID)
    {
        $taskArray = Inspectiontasks::
        where('isDeleted', '0')
        ->where('IJID', $IJID)
        ->pluck('ITID'); //get's the task IDs and stores them in an array

        $length = count($taskArray);
        $i=0;
        while($i < $length)
        {
            $task = Inspectiontasks::findOrFail( $taskArray[$i] );
            $isCompleted = $task->isCompleted;
            //If all inspection tasks are complete, then Job status becomes complete
            if($isCompleted == 1)
            {
                $jobStatus = "complete";
                $i++;   
            }
            else
            {
                $jobStatus = "incomplete";
                break;
            }
        }
        // echo "$jobStatus";

        if($jobStatus == "complete") //If Job status is complete then we can make the Inspection job isCompleted to 1, else no change
        {
            //Set Inspection job isCompleted to 1
            $job = Inspectionjobs::findOrFail($IJID);
            $job->isCompleted = 1;
            $job->save();
        }
    }

    public function editOrderStatusBasedOnRentals($orderID)
    {
        $rentalArray = Rentals::
        where('isDeleted', '0')
        ->where('orderID', $orderID)
        ->pluck('rentalID'); //get's the task IDs and stores them in an array

        $length = count($rentalArray);
        $i=0;
        while($i < $length)
        {
            $rental = Rentals::findOrFail( $rentalArray[$i] );
            $inspectorStatus = $rental->inspectionStatus;
            $ownerStatus = $rental->ownerStatus;
            // $isCompleted = $task->isCompleted;
            //If all inspection tasks are complete, then Job status becomes complete
            if( (($inspectorStatus == "accepted") && ($ownerStatus == "accepted")) || ($ownerStatus == "rejected") || ($inspectorStatus == "rejected") )
            {
                $isApproved = "yes";
                $i++;   
            }
            else
            {
                $isApproved = "no";
                break;
            }
        }

        if($isApproved == "yes") //If Job status is complete then we can make the Inspection job isCompleted to 1, else no change
        {
            //Set Inspection job isCompleted to 1
            $order = Orders::findOrFail($orderID);
            $order->isApproved = 1;
            $order->save();
        }
    }

    public function deductTotalOnRentalReject($orderID, $totalPrice)
    {
        $order = Orders::findOrFail($orderID);
        $total = $order->amount;
        $newTotal = $total - $totalPrice;
        $order->amount = $newTotal;
        $order->save();
    }

    public function removeUser($userID)
    {
        $user = Users::findOrFail($userID); //Find the record in the db of this id
        $user->isDeleted = request('isDeleted');
        $user->save();
    }
}
