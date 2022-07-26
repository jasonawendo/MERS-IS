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

        if($usertype == 'Admin')
        {
            return redirect('/Admin/dashboard');
            //return view('Admin.dashboard');
        }

        else if($usertype == 'Quality Inspector')
        {
            return redirect('/Inspector/dashboard');
            //return view('inspector.dashboard');
        }

        /*else if($usertype == 'Equipment Owner')
        {
            return redirect('/Owner/dashboard');
            #return view('');
        }*/

        else if($usertype == 'Customer')
        {
            return redirect('/Customer/dashboard');
            //return view('inspector.dashboard');
        }

        else
        {
            return view('OLDdashboard');
        }
    }
}
