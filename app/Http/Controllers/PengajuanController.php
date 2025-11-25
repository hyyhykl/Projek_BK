<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->status;
        $nama = $request->nama;
        $tanggal = $request->tanggal;

        $pengajuan = Pengajuan::query()
            ->when($status, function($q) use($status) {
                $q->where('status', $status);
            })
            ->when($nama, function($q) use($nama) {
                $q->where('nama_pelapor', 'LIKE', "%$nama%");
            })
            ->when($tanggal, function($q) use($tanggal) {
                $q->whereDate('created_at', $tanggal);
            })
            ->latest()
            ->get();

        return view('pengajuan.index', compact('pengajuan', 'status', 'nama', 'tanggal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lokasi = Lokasi::all();
        return view('pengajuan.create', compact('lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelapor' => 'required',
            'lokasi_id' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pengajuan_foto', 'public');
        }

        Pengajuan::create([
            'nama_pelapor' => $request->nama_pelapor,
            'lokasi_id' => $request->lokasi_id,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto,
            'status' => 'Menunggu'
        ]);

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengajuan $pengajuan)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }

    public function updateStatus($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        if ($pengajuan->status == 'Menunggu') {
            $pengajuan->status = 'Diproses';
        } elseif ($pengajuan->status == 'Diproses') {
            $pengajuan->status = 'Selesai';
        }

        $pengajuan->save();

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
}
