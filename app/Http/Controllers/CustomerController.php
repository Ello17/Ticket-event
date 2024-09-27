<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    function home(){
        $data=event::all();
        return view('customer.homeCustomer', compact('data'));

    }
}
