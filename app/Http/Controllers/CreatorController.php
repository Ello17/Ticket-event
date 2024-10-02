<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatorController extends Controller
{
    //

    public function homeCreator()
    {
        $user = Auth::user(); 
        $events = Event::where('user_id', $user->id)->get(); 
        
        return view('creator.homeCreator', compact('events'));
    }
}
