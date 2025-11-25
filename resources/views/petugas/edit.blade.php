@extends('layouts.master')

@section('title', 'Edit Data Petugas')

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
    {{-- Tampilkan Validasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali inputan Anda!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>Edit Petugas</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Nama Petugas</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $petugas->name }}">
                </div>
                <div class="form-group">
                    <label>Email Petugas</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $petugas->email }}">
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('petugas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div> 
@endsection