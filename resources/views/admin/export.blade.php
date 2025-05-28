@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Daftar Tamu</h1>

    <div class="mb-3">
        <a href="{{ route('admin.export') }}" class="btn btn-primary">
            <i class="fa fa-download"></i> Ekspor Data Tamu (CSV)
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Tujuan</th>
                <th>No Telepon</th>
                <th>Bidang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tamu as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->instansi }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                <td>{{ $item->tujuan_kunjungan }}</td>
                <td>{{ $item->no_telepon }}</td>
                <td>{{ $item->bidang }}</td>
                <td>
                    @if(strtolower($item->status) == 'active' || strtolower($item->status) == 'aktif')
                        <span class="badge bg-success text-white">Active</span>
                    @else
                        <span class="badge bg-danger text-white">Inactive</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Belum ada data tamu.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
