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
        $usertype=Auth::user()->role;

        if($usertype == 'admin')
        {
            return view('admin');
        }

        else if($usertype == 'equipmentowner')
        {
            return view('equipmentowner');
        }

        else if($usertype == 'qualityinspector')
        {
            return view('qualityinspector');
        }

        else
        {
            return view('dashboard');
        }
    }
}
