@extends('layouts.app')

@section('content')
<!-- Tambahkan CDN FontAwesome jika belum ada di layout -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

<div class="flex min-h-screen bg-gray-100 font-sans">

    <!-- Sidebar -->
    <x-sidebar class="w-64 bg-gray-800 text-white p-6" />

    <!-- Main Content -->
    <main class="flex-1 py-10 px-8 overflow-y-auto">
        <h1 class="text-xl font-bold mb-1">Perwakilan BPKP Daerah Istimewa Yogyakarta</h1>
        <p class="text-sm text-gray-600 mb-6">Dashboard - Ekspor Data</p>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4 flex-wrap gap-4">
                <h2 class="text-lg font-bold">Data Tamu untuk Ekspor</h2>

                <form method="GET" action="{{ route('admin.export.page') }}" class="flex flex-wrap gap-2 items-end">
                   <div class="w-full sm:w-auto">
                        <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="bulan" id="bulan" class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-600 transition-all duration-300 ease-in-out">
                            <option value=""> Pilih Bulan </option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="w-full sm:w-auto">
                        <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <select name="tahun" id="tahun" class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-600 transition-all duration-300 ease-in-out">
                            <option value=""> Pilih Tahun </option>
                            @foreach ($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full sm:w-auto">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition duration-300 ease-in-out transform hover:scale-105">
                            Filter
                        </button>
                    </div>

                    <div class="w-full sm:w-auto">
                        <a href="{{ route('admin.export', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
                           class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105">
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
                            <th class="py-2 px-3">Rating</th> <!-- Menambahkan kolom Rating -->
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

                                <!-- Menampilkan rating dari relasi -->
                                <td class="py-2 px-3">
                                    @php
                                        $rating = optional($item->rating)->nilai ?? 0; // Ambil nilai rating, jika tidak ada set 0
                                    @endphp

                                    <!-- Menampilkan bintang sesuai dengan rating -->
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <i class="fas fa-star text-yellow-400"></i>  <!-- Bintang terisi -->
                                        @else
                                            <i class="fas fa-star text-gray-300"></i>  <!-- Bintang kosong -->
                                        @endif
                                    @endfor
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-4 text-center text-gray-500">Tidak ada data untuk ditampilkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div id="pagination-wrapper" class="mt-4">
                    {{ $tamu->appends(request()->all())->links('vendor.pagination.tailwind') }}
                </div>
                <style>
                    #pagination-wrapper * {
                        background-color: white !important;
                        color: #1f2937 !important;
                        /* text-gray-800 */
                        border-color: #d1d5db !important;
                        /* border-gray-300 */
                    }

                    #pagination-wrapper span[aria-current="page"] {
                        background-color: #2563eb !important;
                        color: white !important;
                        font-weight: bold;
                    }
                </style>
            </div>
        </div>
    </main>
</div>
@endsection
