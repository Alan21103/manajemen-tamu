@extends('layouts.app')

@section('content')
<!-- CDN FontAwesome CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

<div class="flex min-h-screen bg-gray-100 font-sans">
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-1 py-10 px-8 overflow-y-auto">
        <h1 class="text-xl font-bold mb-1">Perwakilan BPKP Daerah Istimewa Yogyakarta</h1>
        <p class="text-sm text-gray-600 mb-6">Dashboard - Lihat Data</p>

        <!-- Data Tamu -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">Riwayat Tamu</h2>
                <form method="GET" action="{{ url()->current() }}" class="flex gap-2" id="filterForm">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Pencarian"
                        class="border rounded px-2 py-1"
                        autocomplete="off"
                    />
                    <select name="sort" class="border rounded px-2 py-1">
                        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Urutkan dari: Terbaru</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Urutkan dari: Terlama</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 rounded hover:bg-blue-700">Filter</button>
                </form>
            </div>

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
                        <th class="py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($tamu as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ $item->nama }}</td>
                        <td>{{ $item->instansi }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                        <td>{{ $item->tujuan_kunjungan }}</td>
                        <td>{{ $item->no_telepon }}</td>
                        <td>{{ $item->bidang }}</td>
                        <td class="py-2">
                            @php $rating = $item->rating ?? 0; @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <span class="text-yellow-400 text-lg inline-block mr-1">★</span>
                                @else
                                    <span class="text-gray-300 text-lg inline-block mr-1">★</span>
                                @endif
                            @endfor
                        </td>
                        <td class="py-2 px-4 flex space-x-3">
                            <a href="{{ route('tamu.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('tamu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-4 text-center text-gray-500">Belum ada data tamu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $tamu->appends(request()->all())->links() }}
            </div>
        </div>

        <!-- Flow Chart + Filter -->
        <div class="bg-white rounded-lg shadow p-6 mt-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold">Grafik Jumlah Tamu</h3>
                <form method="GET" action="{{ url()->current() }}" id="chartFilterForm" class="flex gap-2 items-center" autocomplete="off">
                    <select name="year" class="border rounded p-2">
                        <option value="">Pilih Tahun</option>
                        @foreach ($years as $y)
                            <option value="{{ $y }}" {{ ((int)request('year') === (int)$y) ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>

                    <select name="month" class="border rounded p-2">
                        <option value="">Pilih Bulan</option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ ((int)request('month') === $m) ? 'selected' : '' }}>
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
                borderColor: 'orange',
                backgroundColor: 'rgba(255, 165, 0, 0.2)',
                fill: false,
                tension: 0,
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
            }
        }
    });
})();
</script>

@endsection
