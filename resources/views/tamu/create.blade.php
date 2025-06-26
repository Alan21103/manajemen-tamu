<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Form Tamu</title>
  <link rel="icon" type="image/png" href="/build/assets/img/footer_logo.png">

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <script>
    function toggleLainnyaInput() {
      const lainnyaCheckbox = document.getElementById('lainnya-checkbox');
      const input = document.getElementById('lainnya-input');
      input.style.display = lainnyaCheckbox.checked ? 'block' : 'none';
    }
  </script>
</head>
<body class="bg-gradient-to-b from-blue-50 to-white p-6 font-sans">

  <div class="max-w-3xl mx-auto bg-white/80 backdrop-blur-md p-8 rounded-xl shadow-xl border border-[#1B254B]">
    
    <!-- Header -->
    <header class="bg-blue-900 py-6 text-center rounded-md mb-8 shadow-sm">
      <h2 class="text-white text-3xl font-serif tracking-wide">Formulir Tamu</h2>
      <p class="text-white text-base mt-2 font-light">Silakan isi informasi kunjungan Anda dengan lengkap.</p>
    </header>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 mb-4 rounded border border-green-300">
      {{ session('success') }}
    </div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
    <div class="bg-red-100 text-red-800 p-4 mb-4 rounded border border-red-300">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <!-- Form -->
    <form action="{{ route('tamu.store') }}" method="POST" class="space-y-6">
      @csrf

      <!-- Input Group -->
      @php
        $inputClass = "w-full pl-10 py-3 rounded-md bg-gray-200 border border-[#1B254B] placeholder:text-gray-500 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#1B254B]";
      @endphp

      <!-- Nama -->
      <div>
        <label class="block text-[#1B254B] text-sm font-medium mb-1">
          Nama <span class="text-red-600">*</span>
        </label>
        <div class="relative">
          <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
            <i class="fas fa-user"></i>
          </span>
          <input type="text" name="nama" placeholder="Nama lengkap" class="{{ $inputClass }}" required>
        </div>
      </div>

      <!-- Tanggal -->
      <div>
        <label class="block text-[#1B254B] text-sm font-medium mb-1">
          Tanggal <span class="text-red-600">*</span>
        </label>
        <input type="date" name="tanggal" class="w-full py-3 px-3 rounded-md bg-gray-200 border border-[#1B254B] text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#1B254B]" required>
      </div>

      <!-- Instansi -->
      <div>
        <label class="block text-[#1B254B] text-sm font-medium mb-1">
          Instansi <span class="text-red-600">*</span>
        </label>
        <div class="relative">
          <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
            <i class="fas fa-building"></i>
          </span>
          <input type="text" name="instansi" placeholder="Nama instansi" class="{{ $inputClass }}" required>
        </div>
      </div>

      <!-- No Telepon -->
      <div>
        <label class="block text-[#1B254B] text-sm font-medium mb-1">
          No Telepon <span class="text-red-600">*</span>
        </label>
        <div class="relative">
          <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
            <i class="fas fa-phone-alt"></i>
          </span>
          <input type="text" name="no_telepon" placeholder="Nomor yang bisa dihubungi" class="{{ $inputClass }}" required>
        </div>
      </div>

      <!-- Tujuan Kunjungan -->
      <div>
        <label class="block text-[#1B254B] text-sm font-medium mb-1">
          Tujuan Kunjungan <span class="text-red-600">*</span>
        </label>
        <textarea name="tujuan_kunjungan" rows="3" placeholder="Tuliskan keperluan kunjungan Anda"
          class="w-full py-3 px-3 rounded-md bg-gray-200 border border-[#1B254B] text-gray-800 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#1B254B]" required></textarea>
      </div>

      <!-- Bidang Tujuan -->
      <div>
        <label class="block text-[#1B254B] text-sm font-medium mb-1">
          Bidang Tujuan <span class="text-red-600">*</span>
        </label>
        <div class="grid grid-cols-2 gap-4 text-gray-800 ml-2">
          <label class="flex items-center">
            <input type="checkbox" name="bidang[]" value="Kepala Perwakilan" class="mr-2"> Kepala Perwakilan
          </label>
          <label class="flex items-center">
            <input type="checkbox" name="bidang[]" value="Bagian Umum" class="mr-2"> Bagian Umum
          </label>
          <label class="flex items-center">
            <input type="checkbox" name="bidang[]" value="Sub Bagian" class="mr-2"> Sub Bagian
          </label>
          <label class="flex items-center">
            <input type="checkbox" name="bidang[]" value="Bidang IPP" class="mr-2"> Bidang IPP
          </label>
          <label class="flex items-center">
            <input type="checkbox" name="bidang[]" value="Bidang APD" class="mr-2"> Bidang APD
          </label>
          <label class="flex items-center">
            <input type="checkbox" name="bidang[]" value="Bidang AN" class="mr-2"> Bidang AN
          </label>
          <label class="flex items-center">
            <input type="checkbox" name="bidang[]" value="Bidang Investigasi" class="mr-2"> Bidang Investigasi
          </label>
          <label class="flex items-center">
            <input type="checkbox" name="bidang[]" value="Bidang P3APIP" class="mr-2"> Bidang P3APIP
          </label>
          <label class="flex items-center">
            <input type="checkbox" id="lainnya-checkbox" onclick="toggleLainnyaInput()" class="mr-2"> Lainnya
          </label>
        </div>
        <input type="text" name="bidang[]" id="lainnya-input" placeholder="Tulis bidang lainnya..."
          class="w-full mt-2 py-3 px-3 rounded-md bg-gray-200 border border-[#1B254B] text-gray-800 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#1B254B]" style="display: none;">
      </div>

      <!-- Tombol Submit -->
      <div class="text-right">
        <button type="submit"
          class="bg-blue-900 text-white px-6 py-2 rounded-md font-semibold transition duration-200">
          Kirim
        </button>
      </div>
    </form>
  </div>
</body>
</html>
