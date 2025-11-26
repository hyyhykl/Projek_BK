<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // LOGIN UNTUK ADMIN DAN PETUGAS
        if (Auth::attempt($credentials)) {

            // role akan dibaca di dashboard
            session(['role' => Auth::user()->role]);

            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function dashboard()
    {
        // jika tamu
        if (session('role') == 'tamu') {
            return view('dashboard', ['role' => 'tamu']);
        }

        // jika admin / petugas
        return view('dashboard', ['role' => Auth::user()->role ?? 'tamu']);
    }

    public function logout(Request $request)
    {
        auth()->logout();              // Hapus session login
        $request->session()->invalidate();  
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
