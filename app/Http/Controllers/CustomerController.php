<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    function homeCustomer(){
        $data= Event::all();
        return view('customer.homeCustomer', compact('data'));

    }

    public function detailEvent($id)
    {
        $event = Event::find($id);
        $tiket = Tiket::where('event_id', $id)->get();
        return view('customer.detailEvent', compact('event', 'tiket'));
    }

    public function listEvents()
{

    $events = Event::all();
    return view('customer.listEvent', compact('events'));
}


}
