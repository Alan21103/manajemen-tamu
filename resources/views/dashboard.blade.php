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
      </div>
    </div>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
      <!-- Tamu Hari Ini -->
      <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition-shadow duration-300 flex flex-col">
        <h3 class="font-semibold mb-4">Tamu Hari Ini</h3>
        <div class="flex flex-col items-start space-y-6 flex-grow">
          
<!-- Data Tamu -->
<div class="flex items-center space-x-6">
  <!-- Ikon User (Tanpa Lingkaran) -->
  <div class="text-blue-900 flex items-center justify-center text-6xl">
    <i class="fas fa-user"></i>
  </div>

  <!-- Data Tamu -->
  <div class="text-left">
    <div class="text-2xl font-bold text-blue-900">
      {{ $jumlahTamu ?? 0 }}
    </div>
    <p class="text-gray-500 text-sm">Tamu</p>
    <p class="text-green-500 text-xs">{{ $persentaseTamu ?? '0' }}% dari kemarin</p>
  </div>
</div>


          <!-- Data Instansi -->
<div class="flex items-center space-x-6">
  <!-- Ikon Instansi (Tanpa Lingkaran) -->
  <div class="text-blue-900 flex items-center justify-center text-6xl">
    <i class="fas fa-building"></i>
  </div>

  <!-- Data Instansi -->
  <div class="text-left">
    <div class="text-2xl font-bold text-blue-900">
      {{ $jumlahInstansi ?? 0 }}
    </div>
    <p class="text-gray-500 text-sm">Instansi</p>
    <p class="text-green-500 text-xs">{{ $persentaseInstansi ?? '0' }}% dari kemarin</p>
  </div>
</div>

        </div>

        <!-- Tombol Export di bawah kanan -->
        <div class="flex justify-end mt-6">
<button class="text-white bg-blue-900 border border-blue-900 px-4 py-1 rounded transition-all duration-300"
  onclick="window.location='{{ route('admin.export') }}'">
  Export
</button>

        </div>
      </div>

      <!-- Total Revenue Chart Placeholder -->
<!-- Total Revenue Chart Placeholder -->
<div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
  <h3 class="font-semibold mb-4 text-lg text-gray-800">Jumlah Tamu per Bulan ({{ $tahun }})</h3>
  <div class="relative w-full" style="height: 300px;">
    <canvas id="tamuPerBulanLineChart"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const tamuData = @json($jumlahTamuPerBulan);

  const ctx = document.getElementById('tamuPerBulanLineChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',  // Menggunakan grafik garis
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],  // Label untuk bulan
      datasets: [{
        label: 'Jumlah Tamu',
        data: tamuData,
        fill: true, // Mengisi area di bawah garis
        backgroundColor: 'rgba(30, 64, 175, 0.2)', // Blue 900 dengan transparansi
        borderColor: 'rgba(30, 64, 175, 1)', // Garis berwarna biru 900
        borderWidth: 2,
        tension: 0.4,  // Membuat garis lebih halus
        pointRadius: 4, // Ukuran titik pada garis
        pointBackgroundColor: 'rgba(30, 64, 175, 1)', // Titik warna biru 900
        pointBorderWidth: 2
      }]
    },
    options: {
      responsive: true,
      aspectRatio: 2, // Membuat proporsi lebih lebar
      plugins: {
        legend: {
          display: true,
          labels: {
            font: {
              size: 14,
              family: 'Inter', // Modern font
            },
            color: '#4B5563',
          }
        },
        tooltip: {
          backgroundColor: '#1E40AF', // Warna tooltip biru 900
          titleFont: {
            size: 16
          },
          bodyFont: {
            size: 14
          },
          cornerRadius: 6,
          displayColors: false, // Hapus warna kotak pada tooltip
          callbacks: {
            label: function(context) {
              return `${context.raw} tamu`;
            }
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            font: {
              size: 14
            },
            color: '#4B5563', // Teks sumbu Y berwarna lebih gelap
          },
          grid: {
            color: '#E5E7EB', // Grid warna abu-abu muda
            lineWidth: 1
          }
        },
        x: {
          grid: {
            display: false // Menghilangkan garis grid pada sumbu X
          },
          ticks: {
            font: {
              size: 14
            },
            color: '#4B5563' // Teks sumbu X berwarna lebih gelap
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
