@extends('layouts.app')

@section('content')
  <div class="flex h-screen">

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
      <div class="relative">
      <button class="bg-indigo-600 text-white rounded-full p-2 flex items-center justify-center">
        <i class="fas fa-bell"></i>
      </button>
      </div>
    </div>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
      <!-- Tamu Hari Ini -->
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
      <h3 class="font-semibold mb-4">Tamu Hari Ini</h3>
      <div class="flex items-center space-x-6">
        <div class="text-center">
        <div class="text-2xl font-bold text-indigo-600">
          {{ $jumlahTamu ?? 0 }}
        </div>
        <p class="text-gray-500 text-sm">Tamu</p>
        </div>
        <div class="text-center">
        <div class="text-2xl font-bold text-indigo-600">
          {{ $jumlahInstansi ?? 0 }}
        </div>
        <p class="text-gray-500 text-sm">Instansi</p>
        </div>
        <button class="ml-auto text-blue-600 border border-blue-600 px-4 py-1 rounded hover:bg-blue-50"
        onclick="window.location='{{ route('admin.export') }}'">
        Export
        </button>
      </div>
      </div>

      <!-- Total Revenue Chart Placeholder -->
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
      <h3 class="font-semibold mb-4">Jumlah Tamu per Bulan ({{ $tahun }})</h3>
      <div class="relative w-full" style="height: 300px;">
        <canvas id="tamuPerBulanChart"></canvas>
      </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
      const tamuData = @json($jumlahTamuPerBulan);

      const ctx = document.getElementById('tamuPerBulanChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
          label: 'Jumlah Tamu',
          data: tamuData,
          backgroundColor: [
          '#60A5FA', '#38BDF8', '#0EA5E9', '#0284C7',
          '#2563EB', '#4F46E5', '#7C3AED', '#8B5CF6',
          '#A855F7', '#D946EF', '#EC4899', '#F43F5E'
          ],
          borderRadius: 8
        }]
        },
        options: {
        responsive: true,
        aspectRatio: 2, // membuat proporsi horizontal-lebih panjang
        plugins: {
          legend: {
          display: false
          },
          tooltip: {
          callbacks: {
            label: function (context) {
            return `${context.parsed.y} tamu`;
            }
          }
          }
        },
        scales: {
          y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          },
          grid: {
            color: '#E5E7EB'
          }
          },
          x: {
          grid: {
            display: false
          }
          }
        }
        }
      });
      </script>
    </div>

    <!-- Riwayat Tamu -->
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-shadow duration-300">
      <h3 class="font-semibold mb-4">Riwayat Tamu</h3>
      <div class="flex justify-between mb-4">
      <p class="text-green-600 font-medium">Tamu Aktif</p>
      </div>
      <table class="w-full text-sm text-left">
      <thead class="text-gray-600 border-b">
        <tr>
        <th class="py-2">Nama</th>
        <th>Instansi</th>
        <th>Tanggal</th>
        <th>Tujuan</th>
        <th>Jam</th>
        <th>No Telepon</th>
        <th>Bidang</th>
        <th>Rating</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        @forelse($tamu as $item)
        <tr class="border-b">
        <td class="py-2">{{ $item->nama }}</td>
        <td>{{ $item->instansi }}</td>
        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
        <td>{{ $item->tujuan_kunjungan }}</td>
        <td>{{ \Carbon\Carbon::parse($item->jam)->format('H:i A') }}</td>
        <td>{{ $item->no_telepon }}</td>
        <td>{{ $item->bidang }}</td>

        <td class="flex space-x-1">
        @php
        // Mengambil nilai rating dari relasi rating, jika tidak ada rating beri nilai default 0
        $rating = optional($item->rating)->nilai ?? 0;
      @endphp

        @for ($i = 1; $i <= 5; $i++)
        @if ($i <= $rating)
        <span class="text-yellow-400 text-lg">★</span> <!-- Bintang penuh -->
      @else
        <span class="text-gray-300 text-lg">★</span> <!-- Bintang kosong -->
      @endif
      @endfor
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
    </main>
  </div>
@endsection

