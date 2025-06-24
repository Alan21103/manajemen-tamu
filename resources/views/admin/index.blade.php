@extends('layouts.app')

@section('content')
    <!-- CDN FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="flex min-h-screen bg-gray-100 font-sans">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <main class="flex-1 py-10 px-8 overflow-y-auto">
            <h1 class="text-xl font-bold mb-1">Perwakilan BPKP Daerah Istimewa Yogyakarta</h1>
            <p class="text-sm text-gray-600 mb-6">Dashboard - Lihat Data</p>

            <!-- Data Tamu -->
            <div class="bg-white rounded-lg shadow p-6">
                <!-- Filter Section -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold">Riwayat Tamu</h2>

                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ url()->current() }}" class="flex gap-2" id="filterForm">
                        <!-- Search input -->
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Pencarian"
                            class="border rounded px-2 py-1" autocomplete="off" />

                        <!-- Sort dropdown -->
                        <select name="sort" class="border rounded px-2 py-1">
                            <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Urutkan dari: Terbaru
                            </option>
                            <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Urutkan dari: Terlama
                            </option>
                        </select>

                        <!-- Year Filter Dropdown -->
                        <select name="year" class="border rounded px-2 py-1">
                            <option value="">Pilih Tahun</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>

                        <!-- Submit Button -->
                        <button type="submit" class="bg-blue-600 text-white px-4 rounded hover:bg-blue-700">Filter</button>
                    </form>
                </div>

                <!-- Tamu Table -->
                <table class="w-full text-sm text-left">
                    <thead class="text-gray-600 border-b">
                        <tr>
                            <th class="py-2">Nama</th>
                            <th>Instansi</th>
                            <th>Tanggal</th>
                            <th>Tujuan</th>
                            <th>No Telepon</th>
                            <th>Bidang</th>
                            <th>Rating</th>
                           <th class="py-2 px-4 text-center w-28">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($tamu as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2">{{ $item->nama }}</td>
                                <td>{{ $item->instansi }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                                <td>{{ $item->tujuan_kunjungan }}</td>
                                <td>{{ $item->no_telepon }}</td>
                                <td>{{ $item->bidang }}</td>

                                <td class="flex space-x-1">
                                    @php
                                        // Memastikan rating ada, jika tidak, set default 0
                                        $rating = optional($item->rating)->nilai ?? 0;
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <span class="text-yellow-400 text-lg inline-block mr-1">★</span>
                                            <!-- Bintang berwarna kuning -->
                                        @else
                                            <span class="text-gray-300 text-lg inline-block mr-1">★</span>
                                            <!-- Bintang berwarna abu-abu -->
                                        @endif
                                    @endfor
                                </td>

                              <td class="py-2 px-4">
                                    <div class="flex justify-end items-center space-x-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.tamu.edit', $item->id) }}" title="Edit"
                                            class="p-2 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition duration-200">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <!-- Tombol Delete -->
                                        <form action="{{ route('tamu.destroy', $item->id) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete"
                                                class="p-2 rounded-full bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition duration-200">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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

            <!-- Flow Chart + Filter -->
            <div class="bg-white rounded-lg shadow p-6 mt-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Grafik Jumlah Tamu</h3>
                    <form method="GET" action="{{ url()->current() }}" id="chartFilterForm" class="flex gap-2"
                        autocomplete="off">
                        <select name="year" class="border rounded px-2 py-1">
                            <option value="">Pilih Tahun</option>
                            @foreach ($years as $y)
                                <option value="{{ $y }}" {{ ((int) request('year') === (int) $y) ? 'selected' : '' }}>{{ $y }}
                                </option>
                            @endforeach
                        </select>

                        <select name="month" class="border rounded px-2 py-1">
                            <option value="">Pilih Bulan</option>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ ((int) request('month') === $m) ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                </option>
                            @endfor
                        </select>

                        <button type="submit" class="bg-blue-600 text-white px-4 rounded hover:bg-blue-700">Filter</button>
                    </form>

                </div>

                <canvas id="flowChart" style="max-height: 400px;"></canvas>
            </div>
        </main>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (() => {
            // Ambil label dan data dari backend (label sudah siap pakai)
            const labels = @json($chartData->pluck('label'));
            const data = @json($chartData->pluck('jumlah'));

            const ctx = document.getElementById('flowChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Tamu',
                        data: data,
                        borderColor: '#003366',               // Warna biru BPKP solid
                        backgroundColor: 'rgba(0, 51, 102, 0.2)', // Fill transparan biru BPKP
                        fill: true,
                        tension: 0.4,                         // Garis bergelombang
                        pointBackgroundColor: '#003366',     // Titik data warna biru BPKP
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#003366',            // Label legend warna biru BPKP
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        })();
    </script>

    <!-- SweetAlert Delete -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tangkap semua form dengan class 'delete-form'
            const deleteForms = document.querySelectorAll('.delete-form');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Mencegah submit langsung

                    Swal.fire({
                        title: 'Yakin hapus data ini?',
                        text: "Tindakan ini tidak bisa dibatalkan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#2563eb',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit form secara manual jika dikonfirmasi
                        }
                    });
                });
            });
        });
    </script>
@endsection