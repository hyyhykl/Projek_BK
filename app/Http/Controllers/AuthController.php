<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            session(['role' => Auth::user()->role]);
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function dashboard()
    {
        $role = session('role');

        $menunggu    = Pengajuan::where('status', 'Menunggu')->count();
        $diproses    = Pengajuan::where('status', 'Diproses')->count();
        $selesai     = Pengajuan::where('status', 'Selesai')->count();
        $dibatalkan  = Pengajuan::where('status', 'Dibatalkan')->count();

        $startDate = Carbon::now()->subDays(7);
        $kerusakanBerulang = Pengajuan::select('lokasi_id', 'deskripsi', DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('lokasi_id', 'deskripsi')
            ->having('total', '>', 1)
            ->with('lokasi')
            ->get();

        $weekData = Pengajuan::select(
                DB::raw('WEEK(created_at) as week'),
                DB::raw('SUM(status = "Menunggu") as menunggu'),
                DB::raw('SUM(status = "Diproses") as diproses'),
                DB::raw('SUM(status = "Selesai") as selesai'),
                DB::raw('SUM(status = "Dibatalkan") as dibatalkan')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        $weekLabels      = $weekData->pluck('week');
        $weekMenunggu    = $weekData->pluck('menunggu');
        $weekDiproses    = $weekData->pluck('diproses');
        $weekSelesai     = $weekData->pluck('selesai');
        $weekDibatalkan  = $weekData->pluck('dibatalkan');

        $monthData = Pengajuan::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(status = "Menunggu") as menunggu'),
                DB::raw('SUM(status = "Diproses") as diproses'),
                DB::raw('SUM(status = "Selesai") as selesai'),
                DB::raw('SUM(status = "Dibatalkan") as dibatalkan')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthLabels      = $monthData->pluck('month');
        $monthMenunggu    = $monthData->pluck('menunggu');
        $monthDiproses    = $monthData->pluck('diproses');
        $monthSelesai     = $monthData->pluck('selesai');
        $monthDibatalkan  = $monthData->pluck('dibatalkan');

        return view('dashboard', compact(
            'role',
            'menunggu',
            'diproses',
            'selesai',
            'dibatalkan',
            'kerusakanBerulang',
            'weekLabels',
            'weekMenunggu',
            'weekDiproses',
            'weekSelesai',
            'weekDibatalkan',
            'monthLabels',
            'monthMenunggu',
            'monthDiproses',
            'monthSelesai',
            'monthDibatalkan'
        ));
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}