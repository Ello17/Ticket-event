<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Closure;
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


    public function postLogin(Request $request)
    {
    $data = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($data)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('homeAdmin');
        } else if ($user->role === 'customer') {
            return redirect()->intended(route('homeCustomer'));
        } else if ($user->role === 'creator') {
            return redirect()->route('homeCreator');
        }
    } else {
        return redirect()->route('login')->with('notifikasi', 'Email atau password salah');
    }
    }

    public function loginCreator(){
        return view('template.login');
    }


    public function postLoginCreator(Request $request)
    {
        // Validasi input email dan password
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Coba untuk login
        if (Auth::attempt($data)) {
            $user = Auth::user(); // Mengambil user yang sedang login
    
            // Debugging: Cek apakah kolom is_approved bernilai benar
            if ($user->role === 'creator') {
                if ($user->is_approved == false) { // Pastikan kondisi benar
                    // Logout jika creator belum disetujui
                    Auth::logout();
                    return redirect()->route('loginCreator')->with('notifikasi', 'Akun Anda belum diverifikasi oleh admin.');
                }
            }
    
            // Redireksi berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('homeAdmin');
            } else if ($user->role === 'customer') {
                return redirect()->intended(route('homeCustomer'));
            } else if ($user->role === 'creator') {
                return redirect()->route('homeCreator');
            }
        } else {
            // Jika email atau password salah
            return redirect()->route('loginCreator')->with('notifikasi', 'Email atau password salah.');
        }
    }
    


    public function registerCustomer() {
        return view('template.register');
    }

    public function postRegisterCustomer(Request $request)
    {
    
        $this->validate($request, [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Set role sebagai customer
            'is_approved' => true, // Customer tidak perlu persetujuan
        ]);

        Auth::login($user);

        return redirect()->route('homeCustomer'); // Redirect setelah login
    }


    // public function postRegister(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'username' => 'required|string|max:255|unique:users',
    //         'password' => 'required|string|min:3|confirmed',
    //         'role' => 'required|string',
    //     ]);


    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $user = User::create([
    //         'email' => $request->input('email'),
    //         'username' => $request->input('username'),
    //         'password' => Hash::make($request->input('password')),
    //         'role' => $request->input('role'),
    //     ]);

    //     Auth::login($user); // Jika ingin langsung login setelah register

    //     return redirect()->route('home')->with('notifikasi', 'Akun sukses dibuat');
    // }

    public function registerCreator() {
        return view('template.registerCreator');
    }

    public function postRegisterCreator(Request $request)
{
    // Perbaikan: validasi dengan username dan email yang unik
    $this->validate($request, [
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:3',
    ]);

    // Membuat user baru
    $user = User::create([
        'username' => $request->username, // Menyimpan username
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'creator', // Set role sebagai creator
        'is_approved' => false, // Creator perlu persetujuan admin
    ]);

    // Redirect ke halaman login creator dengan pesan sukses
    return redirect()->route('loginCreator')->with('status', 'Akun Anda telah dibuat, menunggu persetujuan admin.');
}


    protected function create(array $data)
    {
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'is_approved' => false, // Set defaultnya ke false
    ]);
    }

    public function handle($request, Closure $next)
    {
    if (auth()->check() && !auth()->user()->is_approved) {
        auth()->logout();
        return redirect()->route('loginCreator')->withErrors([
            'approval' => 'Akun Anda belum disetujui oleh admin.',
        ]);
    }
    return $next($request);
    }
    public function showPendingUsers()
{
    $pendingUsers = User::where('is_approved', false)->get();
    return view('admin.approveCreator', compact('pendingUsers'));
}

public function approveUser($id)
{
    $user = User::find($id);
    $user->is_approved = true;
    $user->save();

    return redirect()->route('pending.users')->with('success', 'Pengguna berhasil disetujui.');
}




}

