<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //


    public function login(){
        return view('template.login');
    }


    public function postLogin(Request $request)
    {
    $data = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($data)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('homeAdmin')->with('pesan-berhasil', 'Selamat datang' . $user->username);
        } else if ($user->role === 'customer') {
            return redirect()->intended(route('homeCustomer'))->with('pesan-berhasil', 'Selamat datang ' . $user->username);
        } else if ($user->role === 'creator') {
            return redirect()->route('homeCreator')->with('pesan-berhasil', 'Selamat datang' . $user->username);
        }
    } else {
        return redirect()->route('login')->with('pesan-gagal', 'Email atau password salah');
    }
    }

    public function loginCreator(){
        return view('template.loginCreator');
    }


    public function postLoginCreator(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($data)) {
            $user = Auth::user();
            if ($user->role !== 'creator') {
                Log::info('Login ditolak karena peran bukan creator.');
                Auth::logout();
                return redirect()->route('loginCreator')->with('pesan-gagal', 'Hanya akun creator yang diizinkan login.');
            }
            if ($user->is_approved == false) {
                Log::info('User belum diapprove, logout.');
                Auth::logout();
                return redirect()->route('loginCreator')->with('pesan-gagal', 'Akun Anda belum diverifikasi oleh admin.');
            }
            return redirect()->route('homeCreator')->with('pesan-berhasil', 'Selamat datang ' . $user->username);
        } else {
            return redirect()->route('loginCreator')->with('pesan-gagal', 'Email atau password salah.');
        }
    }
    

    public function registerCustomer() {
        return view('template.register');
    }

    // public function postRegisterCustomer(Request $request)
    // {

    //     $this->validate($request, [
    //         'username' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $user = User::create([
    //         'username' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => 'customer', // Set role sebagai customer
    //         'profil' => $request->profil,
    //         'is_approved' => true, // Customer tidak perlu persetujuan
    //     ]);

    //     Auth::login($user);

    //     return redirect()->route('homeCustomer'); // Redirect setelah login
    // }


    public function postRegisterCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('pesan-gagal', 'Akun dengan email atau username ini sudah ada.')->withInput();
        }

        $user = User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => 'customer',
            'profile' => 'default_profile',
        ]);

        Auth::login($user);
        return redirect()->intended(route('homeCustomer'))->with('pesan-berhasil', 'Akun sukses dibuat');
    }


    public function registerCreator() {
        return view('template.registerCreator');
    }

    public function postRegisterCreator(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:3',
            ]);
    
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'creator',
                'is_approved' => false,
            ]);
    
            return redirect()->route('loginCreator')->with('pesan-berhasil', 'Akun Anda telah dibuat. Silakan tunggu 2-3 hari untuk disetujui admin.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors();
    
            if ($errors->has('username')) {
                return redirect()->back()->withInput()->with('pesan-gagal', 'Username sudah digunakan. Silakan pilih username lain.');
            }
    
            if ($errors->has('email')) {
                return redirect()->back()->withInput()->with('pesan-gagal', 'Email sudah terdaftar. Silakan gunakan email lain.');
            }
    
            return redirect()->back()->withInput()->with('pesan-gagal', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
    

    public function logout()
    {
    Auth::logout();
    session()->flush();
    return redirect()->route('login')->with('pesan-berhasil', 'Berhasil Logout, Silahkan Login Kembali');
    }


    
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

   
    public function ResetForm($token)
    {
        return view('password.reset', ['token' => $token]);
    }

   
    public function postReset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:3|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}

