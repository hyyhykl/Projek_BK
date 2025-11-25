@extends('layouts.master')

@section('title', 'Edit Data Lokasi Kerusakan')

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
            <h5>Edit Data Lokasi Kerusakan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label for="gedung">Nama Gedung</label>
                    <input type="text" name="gedung" id="gedung" class="form-control" value="{{ $lokasi->gedung }}" required>
                </div>
                <div class="form-group">
                    <label for="ruangan">Nama Ruangan</label>
                    <input type="text" name="ruangan" id="ruangan" class="form-control" value="{{ $lokasi->ruangan }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div> 
@endsection