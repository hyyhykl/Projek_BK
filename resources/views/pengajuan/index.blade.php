@extends('layouts.master')

@section('title', 'Data Pengajuan Kerusakan')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard Analytics</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
<div class="col-xl-12">
<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Data Pengajuan Kerusakan</h5>
    </div>

    <div class="card-body table-border-style">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pelapor</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-center">
                @forelse ($pengajuan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->created_at->format('d M Y') }}</td>
                        <td>{{ $item->nama_pelapor }}</td>
                        <td>{{ $item->lokasi->gedung ?? '-' }} - {{ $item->lokasi->ruangan ?? '-' }}</td>

                        {{-- BADGE STATUS --}}
                        <td>
                            @if ($item->status == 'Menunggu')
                                <span class="badge badge-light-warning">Menunggu</span>
                            @elseif ($item->status == 'Diproses')
                                <span class="badge badge-light-primary">Diproses</span>
                            @elseif ($item->status == 'Selesai')
                                <span class="badge badge-light-success">Selesai</span>
                            @elseif ($item->status == 'Dibatalkan')
                                <span class="badge badge-light-danger">Dibatalkan / Gagal</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>

                            {{-- Tombol lihat → semua role --}}
                            <button class="btn btn-sm btn-info"
                                data-toggle="modal"
                                data-target="#modalDetail{{ $item->id }}">
                                <i class="feather icon-info"></i> Lihat
                            </button>

                            {{-- ADMIN & PETUGAS --}}
                            @if (session('role') == 'admin' || session('role') == 'petugas')

                                {{-- STATUS: MENUNGGU --}}
                                @if ($item->status == 'Menunggu')

                                    {{-- MULAI PROSES --}}
                                    <form action="{{ route('pengajuan.updateStatus', $item->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Diproses">
                                        <button class="btn btn-sm btn-primary">Mulai Proses</button>
                                    </form>

                                    {{-- BATALKAN → MODAL --}}
                                    <button class="btn btn-sm btn-danger"
                                        data-toggle="modal"
                                        data-target="#modalBatal{{ $item->id }}">
                                        Batalkan
                                    </button>

                                {{-- STATUS: DIPROSES --}}
                                @elseif ($item->status == 'Diproses')

                                    <form action="{{ route('pengajuan.updateStatus', $item->id) }}"
                                          method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="Selesai">
                                        <button class="btn btn-sm btn-primary">Tandai Selesai</button>
                                    </form>

                                @endif
                            @endif

                        </td>
                    </tr>

                    {{-- ============================
                        MODAL DETAIL PENGAJUAN
                    ============================= --}}
                    <div class="modal fade" id="modalDetail{{ $item->id }}">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title text-white">Detail Pengajuan</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal">
                                        <i class="feather icon-x"></i>
                                    </button>
                                </div>

                                <div class="modal-body p-4">
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <strong>Nama Pelapor:</strong>
                                            <p>{{ $item->nama_pelapor }}</p>
                                        </div>
                                        <div class="col-6">
                                            <strong>Status:</strong><br>
                                            @if ($item->status == 'Menunggu')
                                                <span class="badge badge-light-warning">Menunggu</span>
                                            @elseif ($item->status == 'Diproses')
                                                <span class="badge badge-light-primary">Diproses</span>
                                            @elseif ($item->status == 'Selesai')
                                                <span class="badge badge-light-success">Selesai</span>
                                            @elseif ($item->status == 'Dibatalkan')
                                                <span class="badge badge-light-danger">Dibatalkan</span>
                                                <p><strong>Alasan:</strong> {{ $item->alasan_dibatalkan }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Lokasi Kerusakan:</strong>
                                        <p>{{ $item->lokasi->gedung ?? '-' }} - {{ $item->lokasi->ruangan ?? '-' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Deskripsi Kerusakan:</strong>
                                        <p class="text-muted">{{ $item->deskripsi }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <strong>Foto Bukti:</strong><br>
                                        @if($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                 class="img-fluid rounded shadow"
                                                 style="max-height: 300px;">
                                        @else
                                            <p class="text-muted">Tidak ada foto</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- TOMBOL DI MODAL --}}
                                @if(session('role') == 'admin' || session('role') == 'petugas')

                                    @if ($item->status == 'Menunggu')
                                        <div class="p-3">
                                            <form action="{{ route('pengajuan.updateStatus', $item->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="Diproses">
                                                <button class="btn btn-primary">Mulai Proses</button>
                                            </form>

                                            <button class="btn btn-danger"
                                                data-toggle="modal"
                                                data-target="#modalBatal{{ $item->id }}">
                                                Batalkan
                                            </button>
                                        </div>
                                    @elseif ($item->status == 'Diproses')
                                        <div class="p-3">
                                            <form action="{{ route('pengajuan.updateStatus', $item->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="Selesai">
                                                <button class="btn btn-primary">Tandai Selesai</button>
                                            </form>
                                        </div>
                                    @endif

                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- ============================
                        MODAL ALASAN PEMBATALAN
                    ============================= --}}
                    <div class="modal fade" id="modalBatal{{ $item->id }}">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('pengajuan.updateStatus', $item->id) }}">
                                @csrf @method('PATCH')
                                <div class="modal-content">

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Alasan Pembatalan</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <label>Masukan alasan pembatalan:</label>
                                        <textarea name="alasan_dibatalkan" class="form-control" required>
                                        </textarea>

                                        <input type="hidden" name="status" value="Dibatalkan">
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-danger" type="submit">Simpan</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                @empty
                    <tr>
                        <td colspan="6" class="text-muted py-3">
                            Belum ada pengajuan kerusakan
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
</div>
</div>

@endsection