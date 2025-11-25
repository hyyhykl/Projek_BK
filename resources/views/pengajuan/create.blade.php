@extends('layouts.master')

@section('title', 'Tambah Laporan Kerusakan')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard Analytics</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Form Tambah Laporan Kerusakan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Nama Pelapor</label>
                    <input type="text" name="nama_pelapor" id="" class="form-control" placeholder="Masukkan Nama Pelapor" required>
                </div> 
                <div class="form-group">
                    <label for="">Lokasi Kerusakan</label>
                    <select name="lokasi_id" id="" class="form-control" required>
                        <option value="" disabled selected>Pilih Lokasi Kerusakan</option>
                        @foreach($lokasi as $item)
                            <option value="{{ $item->id }}">{{ $item->gedung }} - {{ $item->ruangan }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="form-group">
                    <label for="">Deskripsi Kerusakan</label>
                    <textarea name="deskripsi" id="" class="form-control" rows="4" placeholder="Jelaskan kerusakan secara detail" required></textarea>
                </div> 
                <div class="form-group">
                    <label for="">Bukti Foto Kerusakan</label>
                    <input type="file" name="foto" id="" class="form-control" accept="image/*" required>
                </div> 
                <input type="hidden" name="status" value="Menunggu"> 
                <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
            </form>
        </div>
    </div>
@endsection