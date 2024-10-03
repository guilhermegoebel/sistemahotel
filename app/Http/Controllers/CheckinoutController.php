<?php

namespace App\Http\Controllers;

use App\Models\Checkinout;

class CheckinoutController extends Controller
{
    public function checkin(){
        return view('checkin.index');
    }
    public function checkout(){
        return view('checkout.index');
    }
}
