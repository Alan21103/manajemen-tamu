@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
<!-- Sidebar + Konten -->
<div class="flex min-h-screen bg-gray-100 font-sans">
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-1 py-10 px-8 overflow-y-auto">
        <h1 class="text-xl font-bold mb-1">Perwakilan BPKP Daerah Istimewa Yogyakarta</h1>
        <p class="text-sm text-gray-600 mb-6">Dashboard - Tambah Data</p>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-semibold mb-6">Tambah Data</h2>
            <p class="mb-6 text-gray-500">Form Tambah</p>

            @if(session('success'))
                <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.tambahdata') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none">
                </div>

                <!-- Instansi -->
                <div>
                    <label for="instansi" class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
                    <input type="text" name="instansi" id="instansi" value="{{ old('instansi') }}" placeholder="Masukkan Instansi"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none">
                </div>

                <!-- No Telepon -->
                <div>
                    <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}" placeholder="Masukkan Nomor Telepon"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none">
                </div>

                <!-- Tanggal & Tujuan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none">
                    </div>

                    <div>
                        <label for="tujuan_kunjungan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan Kunjungan</label>
                        <textarea name="tujuan_kunjungan" id="tujuan_kunjungan" rows="2"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none resize-none"
                            placeholder="Masukkan Tujuan">{{ old('tujuan_kunjungan') }}</textarea>
                    </div>
                </div>

                <!-- Bidang -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bidang</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach (['Kepala Perwakilan', 'Bagian Umum', 'Sub-Bagian', 'Lainnya'] as $value)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="bidang[]" value="{{ $value }}"
                                    class="text-purple-600 rounded" {{ in_array($value, old('bidang', [])) ? 'checked' : '' }}>
                                <span>{{ $value }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Tombol -->
<!-- Tombol -->
<div class="flex justify-end">
    <button type="submit"
        class="bg-indigo-900 text-white py-2 px-6 rounded-md hover:bg-indigo-800 transition duration-200">
        Tambah
    </button>
</div>

            </form>
        </div>
    </main>
</div>
@endsection
