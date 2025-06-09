@extends('layouts.app')

@section('content')
<!-- Tambahkan CDN FontAwesome jika belum ada di layout -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

<div class="flex min-h-screen bg-gray-100 font-sans">

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-1 py-10 px-8 overflow-y-auto">
        <h1 class="text-xl font-bold mb-1">Perwakilan BPKP Daerah Istimewa Yogyakarta</h1>
        <p class="text-sm text-gray-600 mb-6">Dashboard - Ekspor Data</p>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4 flex-wrap gap-4">
                <h2 class="text-lg font-bold">Data Tamu untuk Ekspor</h2>

                <form method="GET" action="{{ route('admin.export.page') }}" class="flex flex-wrap gap-2 items-end">
                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="bulan" id="bulan" class="border rounded px-2 py-1">
                            <option value="">-- Pilih Bulan --</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <select name="tahun" id="tahun" class="border rounded px-2 py-1">
                            <option value="">-- Pilih Tahun --</option>
                            @foreach ($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Filter
                        </button>
                    </div>

                    <div>
                        <a href="{{ route('admin.export', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
                           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 inline-flex items-center">
                            <i class="fas fa-download mr-2"></i> Download Excel
                        </a>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="py-2 px-3">No</th>
                            <th class="py-2 px-3">Nama</th>
                            <th class="py-2 px-3">Instansi</th>
                            <th class="py-2 px-3">Tanggal</th>
                            <th class="py-2 px-3">Jam</th>
                            <th class="py-2 px-3">Tujuan</th>
                            <th class="py-2 px-3">No Telepon</th>
                            <th class="py-2 px-3">Bidang</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @forelse ($tamu as $index => $item)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="py-2 px-3">{{ $index + 1 }}</td>
                                <td class="py-2 px-3">{{ $item->nama }}</td>
                                <td class="py-2 px-3">{{ $item->instansi }}</td>
                                <td class="py-2 px-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td class="py-2 px-3">{{ \Carbon\Carbon::parse($item->jam)->format('H:i') }}</td>
                                <td class="py-2 px-3">{{ $item->tujuan_kunjungan }}</td>
                                <td class="py-2 px-3">{{ $item->no_telepon }}</td>
                                <td class="py-2 px-3">{{ $item->bidang }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-4 text-center text-gray-500">Tidak ada data untuk ditampilkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
