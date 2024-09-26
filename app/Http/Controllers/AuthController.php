<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
<<<<<<< HEAD
    function home(){
        return view('customer.homeCustomer');
=======

    public function login(){
        return view('template.login');
    }

    public function postLogin(Request $request){
        $data = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($data)){
            $user = Auth::user();

            if ($user->role === 'admin'){
                return redirect()->route('admin.homeAdmin');
            } else if ($user->role === 'customer'){
                return redirect()->route('customer.homeCustomer');
            } else if ($user->role === 'creator'){
                return redirect()->route('creator.homeCreator');
            }

        } else {
            return redirect()->route('postLogin')->with('notifikasi', 'Username atau password salah');
        }
>>>>>>> 53d2e0d2b01d8c9eab901e1f3b1133cce3ff6e59
    }
}
