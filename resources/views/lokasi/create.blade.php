@extends('layouts.master')

@section('title', 'Tambah Data Lokasi Kerusakan')

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
            <h5>Tambah Data Lokasi Kerusakan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('lokasi.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="gedung">Gedung</label>
                    <input type="text" name="gedung" id="gedung" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="ruangan">Ruangan</label>
                    <input type="text" name="ruangan" id="ruangan" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div> 
@endsection