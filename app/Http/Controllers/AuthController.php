<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //


    public function login(){
        return view('template.login');
    }

    public function postlogin(Request $request){

            // Validasi input login
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $role = $user->role;

        // Redirect berdasarkan role
        switch ($role) {
            case 'admin':
                return redirect()->route('homeAdmin')->with('notifikasi', 'SELAMAT DATANG (Admin) ' .$user->name);
            case 'customer':
                return redirect()->route('home')->with('notifikasi', 'SELAMAT DATANG ' .$user->name);
            default:
                return redirect('/');
            }
        }
        // Jika login gagal
        return back()->withErrors(['notifikasi' => 'Invalid email or password',]);
    }
        // $data = $request->validate([
        //     'username' => ['required'],
        //     'password' => ['required']
        // ]);

        // if (Auth::attempt($data)){
        //     $user = Auth::user();

        //     if ($user->role === 'admin'){
        //         return redirect()->route('admin.homeAdmin');
        //     } else if ($user->role === 'customer'){
        //         return redirect()->route('customer.homeCustomer');
        //     } else if ($user->role === 'creator'){
        //         return redirect()->route('creator.homeCreator');
        //     }

        // } else {
        //     return redirect()->route('postlogin')->with('notifikasi', 'Username atau password salah');
        // }

}

