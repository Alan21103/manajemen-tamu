<div class="flex min-h-screen bg-gray-100 font-sans">

  <!-- Sidebar -->
  <x-sidebar />

  <!-- Main Content -->
  <main class="flex-1 py-12 px-6 overflow-y-auto">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <!-- Header -->
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-6">
        Data Tamu
      </h2>

      <!-- Konten Data Tamu -->
      <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
        <table class="min-w-full text-sm text-left">
          <thead class="bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
            <tr>
              <th class="p-2">Nama</th>
              <th class="p-2">Tanggal</th>
              <th class="p-2">Instansi</th>
              <th class="p-2">No Telepon</th>
              <th class="p-2">Tujuan</th>
              <th class="p-2">Bidang</th>
            </tr>
          </thead>
          <tbody>
            @forelse($tamu as $item)
              <tr class="border-b border-gray-300 dark:border-gray-600">
                <td class="p-2">{{ $item->nama }}</td>
                <td class="p-2">{{ $item->tanggal }}</td>
                <td class="p-2">{{ $item->instansi }}</td>
                <td class="p-2">{{ $item->no_telepon }}</td>
                <td class="p-2">{{ $item->tujuan_kunjungan }}</td>
                <td class="p-2">{{ $item->bidang }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data tamu.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </main>

</div>
