<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //


    public function login(){
        return view('template.login');
    }

    public function postlogin(Request $request){

        $data = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($data)){
            $user = Auth::user();

            if ($user->role === 'admin'){
                return redirect()->route('admin.homeAdmin');
            } else if ($user->role === 'customer'){
                return redirect()->route('customer.home');
            } else if ($user->role === 'creator'){
                return redirect()->route('creator.homeCreator');
            }

        } else {
            return redirect()->route('login')->with('notifikasi', 'Username atau password salah');
        }
    }


    public function register() {
        return view('template.register');
    }

    public function postRegister(Request $request)
    {
        // Validasi inputan
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'role' => 'required|string',
        ]);
    
        // Jika validasi gagal, kembali ke form dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Jika validasi berhasil, buat user baru
        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);
    
        // Auth::login($user); // Jika ingin langsung login setelah register
    
        return redirect()->route('home')->with('notifikasi', 'Akun sukses dibuat');
    }
    
}

