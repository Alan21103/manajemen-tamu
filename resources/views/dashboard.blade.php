<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard BPKP</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

  <!-- Layout Wrapper -->
  <div class="flex h-screen">

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">

      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Dashboard</h2>
        <div class="text-gray-600"><i class="bell">🔔</i></div>
      </div>

      <!-- Top Stats -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-6">
        <!-- Tamu Hari Ini -->
        <div class="bg-white p-6 rounded-xl shadow">
          <h3 class="font-semibold mb-4">Tamu Hari ini</h3>
          <div class="flex items-center space-x-6">
            <div class="text-center">
              <div class="text-2xl font-bold">8</div>
              <p class="text-gray-500 text-sm">Tamu</p>
            </div>
            <div class="text-center">
              <div class="text-2xl font-bold">5</div>
              <p class="text-gray-500 text-sm">Instansi</p>
            </div>
            <button class="ml-auto text-blue-600 border border-blue-600 px-4 py-1 rounded hover:bg-blue-50"
              onclick="window.location='{{ route('admin.export') }}'">
              Export
            </button>

          </div>
        </div>

        <!-- Total Revenue Chart Placeholder -->
        <div class="bg-white p-6 rounded-xl shadow">
          <h3 class="font-semibold mb-4">Total Revenue</h3>
          <div class="w-full h-32 bg-gray-100 rounded flex items-center justify-center text-gray-400">[Chart
            Placeholder]</div>
        </div>
      </div>

      <!-- Riwayat Tamu -->
      <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-semibold mb-4">Riwayat Tamu</h3>
        <div class="flex justify-between mb-4">
          <p class="text-green-600 font-medium">Tamu Aktif</p>
          <input type="text" placeholder="Pencarian" class="border p-2 rounded w-1/3">
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
            @php $rating = $item->rating ?? 0; @endphp
            @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $rating)
          <span class="text-yellow-400 text-lg">★</span>
          @else
          <span class="text-gray-300 text-lg">★</span>
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
      </div>
    </main>
  </div>
</body>

</html>