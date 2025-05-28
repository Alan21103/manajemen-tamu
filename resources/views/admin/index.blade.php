@extends('layouts.app')

@section('content')
<!-- Tambahkan CDN FontAwesome CSS -->
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
    <select name="sort" class="border rounded px-2 py-1" onchange="document.getElementById('filterForm').submit()">
        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Urutkan dari: Terbaru</option>
        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Urutkan dari: Terlama</option>
    </select>
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
                        <th class="py-2 px-4">Action</th> <!-- Kolom Action -->
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

                        <!-- Rating tanpa flex, bintang berjajar rapi -->
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

                        <!-- Kolom Action dengan flex dan jarak antar icon -->
                        <td class="py-2 px-4 flex space-x-3">
                            <a href="{{ route('tamu.edit', $item->id) }}" 
                               class="text-blue-600 hover:text-blue-800" 
                               title="Edit">
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
                        <td colspan="9" class="py-4 text-center text-gray-500">Belum ada data tamu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $tamu->appends(request()->all())->links() }}
            </div>
        </div>

        <!-- Flow Chart -->
        <div class="bg-white rounded-lg shadow p-6 mt-8">
            <h3 class="text-lg font-bold mb-4">Flow Chart Tamu</h3>
            <canvas id="flowChart"></canvas>
        </div>
    </main>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('flowChart').getContext('2d');
    const flowChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['20 Apr', '21 Apr', '22 Apr', '23 Apr', '24 Apr', '25 Apr', '26 Apr', '27 Apr', '28 Apr', '29 Apr'],
            datasets: [{
                label: 'Revenues',
                data: [10000, 12000, 15000, 18000, 16000, 17000, 19000, 20345, 17500, 14000],
                borderColor: 'orange',
                backgroundColor: 'rgba(255, 165, 0, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Revenue: $' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
