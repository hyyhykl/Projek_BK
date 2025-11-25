@extends('layouts.master')

@section('title', 'Data Lokasi Kerusakan')

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
            <h5>Data Lokasi Kerusakan</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('lokasi.create') }}" class="btn btn-primary mb-3"><i class="feather mr-2 icon-plus"></i>Tambah Lokasi</a>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gedung</th>
                            <th>Ruangan</th>
                            <th width="150px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lokasi as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->gedung }}</td>
                                <td>{{ $item->ruangan }}</td>
                                <td>
                                    <a href="{{ route('lokasi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('lokasi.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted p-3">
                                        Belum ada data lokasi.
                                    </td>
                                </tr>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $lokasi->links() }}
        </div>
    </div>
@endsection