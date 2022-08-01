<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Users;

class HomeController extends Controller
{
    public function redirect()
    {
        //Getting the user type during login from the user's credentials entered.
        //$usertype=Auth::user()->role;

        $user = auth()->user();
        $usertype = $user->role;
        $status = $user->isDeleted;

        if($usertype == 'Admin')
        {
            return redirect('/Admin/dashboard');
        }
        else if($usertype == 'Quality Inspector')
        {
            return redirect('/Inspector/dashboard');
        }

        if($status == 0)
        {
            if($usertype == 'Equipment Owner')
            {
                return redirect('/Owner/dashboard');
            }

            else if($usertype == 'Customer')
            {
                return redirect('/Customer/home');
            }

            else
            {
                return view('OLDdashboard');
            }
        }

        else if(($status == 1))
        {
            return redirect('/waiting');
        }
        }

        
}