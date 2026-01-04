<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

// buat urusan login dan register
use Illuminate\Support\Facades\Auth;

// untuk enkripsi password
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi: mastiin data yang dikirim user itu bener
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // dd(Auth::user());
            // Login berhasil, lempar ke halaman home
            // untuk gerbang tampilan admin atau user biasa tidak disini melainkan ada di vieews layout main
            return redirect()->intended('/home')->with('welcome', 'Selamat Datang Kembali!');
        }

        // Kalo gagal, balik lagi ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1. Validasi: mastiin data yang dikirim user itu bener
        $request->validate([
            'username' => 'required|unique:users', // username harus diisi & belum ada di db
            'password' => 'required|min:6|confirmed', // password minimal 6 karakter & harus cocok sama field konfirmasi
            'email' => 'required|email|unique:users', // email harus diisi, format email, & belum ada di db
        ]);

        // 2. Simpan ke Database
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password WAJIB di-hash/encrypt biar aman!
            'email' => $request->email,
            'role' => 'user', // Default role buat user biasa
            'help_point' => 0, // Awalnya nol, nanti nambah kalau dia bantu balikin barang
        ]);

        // 3. lempar ke halaman login setelah berhasil daftar
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        
        // supaya sessionnya bener bener bersih
        $request->session()->invalidate();

        // supaya token CSRF nya ganti baru
        $request->session()->regenerateToken();

        return redirect('/home')->with('warning', 'Anda telah logout!');
    }
}
