<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Lokasi;
use App\Models\User;
use App\Notifications\PengajuanBaruNotification;  
use App\Notifications\StatusPengajuanNotification;
use Illuminate\Support\Facades\Notification; 
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $nama = $request->nama;
        $tanggal = $request->tanggal;

        $pengajuan = Pengajuan::query()
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($nama, fn($q) => $q->where('nama_pelapor', 'LIKE', "%$nama%"))
            ->when($tanggal, fn($q) => $q->whereDate('created_at', $tanggal))
            ->latest()
            ->get();

        return view('pengajuan.index', compact('pengajuan', 'status', 'nama', 'tanggal'));
    }

    public function create()
    {
        $lokasi = Lokasi::all();
        return view('pengajuan.create', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required',
            'lokasi_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foto = $request->hasFile('foto')
            ? $request->file('foto')->store('pengajuan_foto', 'public')
            : null;

        $pengajuan = Pengajuan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'lokasi_id'    => $request->lokasi_id,
            'deskripsi'    => $request->deskripsi,
            'foto'         => $foto,
            'status'       => 'Menunggu'
        ]);

        // Kirim notifikasi ke admin
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new PengajuanBaruNotification($pengajuan));

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil ditambahkan.');
    }

    public function show($id)
    {
        return response()->json(
            Pengajuan::with('lokasi')->findOrFail($id)
        );
    }

    public function edit(Pengajuan $pengajuan) {}

    public function update(Request $request, Pengajuan $pengajuan) {}

    public function destroy(Pengajuan $pengajuan)
    {
        // boleh hapus jika status = selesai
        if ($pengajuan->status !== 'Selesai') {
            return back()->with('error', 'Hanya data selesai yang boleh dihapus.');
        }

        $pengajuan->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Update Status FINAL VERSION
     */
    public function updateStatus(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        // VALIDASI
        $allowed = ['Menunggu', 'Diproses', 'Selesai', 'Dibatalkan'];

        if ($request->has('status')) {
            $newStatus = $request->input('status');

            if (! in_array($newStatus, $allowed)) {
                return back()->with('error', 'Status tidak valid.');
            }

            // Jika dibatalkan, wajib ada alasan
            if ($newStatus == 'Dibatalkan') {
                $request->validate([
                    'alasan_dibatalkan' => 'required'
                ]);

                $pengajuan->alasan_dibatalkan = $request->input('alasan_dibatalkan');
            }

            $pengajuan->status = $newStatus;
            $pengajuan->save();

            // NOTIFIKASI
            $this->sendStatusNotification($pengajuan);

            return back()->with('success', "Status diubah menjadi $newStatus.");
        }

        return back()->with('error', 'Aksi tidak valid.');
    }

    /**
     * Fungsi kirim notifikasi (dipakai dua tempat)
     */
    private function sendStatusNotification(Pengajuan $pengajuan)
    {
        // jika pengajuan terkait user
        if (!empty($pengajuan->user_id)) {
            $user = User::find($pengajuan->user_id);
            if ($user) {
                $user->notify(new StatusPengajuanNotification($pengajuan));
                return;
            }
        }

        // cek berdasarkan email jika ada
        if (!empty($pengajuan->email)) {
            $user = User::where('email', $pengajuan->email)->first();
            if ($user) {
                $user->notify(new StatusPengajuanNotification($pengajuan));
                return;
            }
        }

        // default → kirim ke semua admin
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new StatusPengajuanNotification($pengajuan));
    }
}