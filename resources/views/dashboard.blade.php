@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ROLE ADMIN --}}
@if(session('role') == 'admin')
    <div class="card">
        <div class="card-body">
            <h4>Dashboard Admin</h4>
            <p>Menu: Kelola Petugas, Kelola Lokasi, Kelola Pengajuan, dsb.</p>
        </div>
    </div>

{{-- ROLE PETUGAS --}}
@elseif(session('role') == 'petugas')
    <div class="card">
        <div class="card-body">
            <h4>Dashboard Petugas</h4>
            <p>Menu: Lihat Pengajuan, Update Status, dsb.</p>
        </div>
    </div>

{{-- ROLE TAMU / PENGGUNA --}}
@else
    <div class="card">
        <div class="card-body">
            <h4>Dashboard Pengguna</h4>
            <a href="{{ route('pengajuan.create') }}" class="btn btn-primary">
                Tambah Pengajuan
            </a>
        </div>
    </div>
@endif

@endsection