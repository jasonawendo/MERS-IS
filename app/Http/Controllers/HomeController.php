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
        }
        else if($usertype == 'Quality Inspector')
        {
            return redirect('/Inspector/dashboard');
        }

        /*else if($usertype == 'Equipment Owner')
        {
            return view('');
        }*/

        else
        {
            return view('OLDdashboard');
        }
    }
}