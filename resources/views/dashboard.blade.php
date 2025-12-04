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
        </div>
    </div>

{{-- ROLE PETUGAS --}}
@elseif(session('role') == 'petugas')
    <div class="card">
        <div class="card-body">
            <h4>Dashboard Petugas</h4>
        </div>
    </div>

{{-- ROLE TAMU --}}
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


{{-- 🔥 INFO KERUSAKAN BERULANG --}}
@if(count($kerusakanBerulang) > 0)
<div class="col-md-12">
    <div class="card bg-danger text-white">
        <div class="card-header">
            <h5>Kerusakan Berulang Minggu Ini</h5>
        </div>
        <div class="card-body">
            <ul style="list-style:none;padding-left:0;">
                @foreach ($kerusakanBerulang as $item)
                    <li class="mb-2">
                        <strong>{{ $item->lokasi->gedung }} - {{ $item->lokasi->ruangan }}</strong> terjadi
                        <strong>{{ $item->total }}</strong> kali dalam minggu ini.
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

{{-- 🔥 CHARTS --}}
<div class="row">

    {{-- WEEKLY --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Rekap Pengajuan per Minggu</h5>
            </div>
            <div class="card-body">
                <div id="chart-week"></div>
            </div>
        </div>
    </div>

    {{-- MONTHLY --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Rekap Pengajuan per Bulan</h5>
            </div>
            <div class="card-body">
                <div id="chart-month"></div>
            </div>
        </div>
    </div>
    
</div>


{{-- APEXCHARTS --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // =====================================
    // 🔥 MULTI-SERIES WEEKLY
    // =====================================
    var weeklyOptions = {
        chart: { type: 'line', height: 300 },
        series: [
            { name: 'Menunggu', data: {!! json_encode($weekMenunggu) !!} },
            { name: 'Diproses', data: {!! json_encode($weekDiproses) !!} },
            { name: 'Selesai',  data: {!! json_encode($weekSelesai) !!} },
            { name: 'Dibatalkan/Gagal', data: {!! json_encode($weekDibatalkan) !!} }
        ],
        xaxis: {
            categories: {!! json_encode($weekLabels) !!},
        },
        stroke: { curve: 'smooth', width: 3 },
        markers: { size: 4 },
        colors: ['#ffca28', '#1e88e5', '#43a047', '#e53935']
    };
    new ApexCharts(document.querySelector("#chart-week"), weeklyOptions).render();


    // =====================================
    // 🔥 MULTI-SERIES MONTHLY
    // =====================================
    var monthlyOptions = {
        chart: { type: 'line', height: 300 },
        series: [
            { name: 'Menunggu', data: {!! json_encode($monthMenunggu) !!} },
            { name: 'Diproses', data: {!! json_encode($monthDiproses) !!} },
            { name: 'Selesai',  data: {!! json_encode($monthSelesai) !!} },
            { name: 'Dibatalkan/Gagal', data: {!! json_encode($monthDibatalkan) !!} }
        ],
        xaxis: {
            categories: {!! json_encode($monthLabels) !!}
        },
        stroke: { curve: 'smooth', width: 3 },
        markers: { size: 4 },
        colors: ['#ffca28', '#1e88e5', '#43a047', '#e53935']
    };
    new ApexCharts(document.querySelector("#chart-month"), monthlyOptions).render();

</script>

@endsection