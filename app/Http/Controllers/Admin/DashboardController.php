<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserEmailVerification;

class DashboardController extends Controller
{

    /*
    * Show the profile for a given user.
    */
    public function dashboard()
    {       
        return view('admin.dashboard');
    }




  

}