<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    function home(){
        $data= Event::all();
        return view('customer.homeCustomer', compact('data'));

    }

    public function detailEvent(Event $event)
    {
        $tikets = Tiket::where('event_id', $event->id)->get();
        return view('customer.detailEvent', compact('event', 'tikets'));
    }
}
