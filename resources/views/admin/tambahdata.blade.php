@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100 font-sans">
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <div class="p-8 w-full">
        <!-- Judul -->
        <div class="mb-4">
            <h1 class="text-2xl font-semibold">Tambah Data</h1>
            <p class="text-gray-500">Tolong isi form di bawah ini</p>
        </div>

        <!-- Card/Form -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('tamu.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan Nama"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:outline-none">
                </div>

                <!-- Instansi (Dropdown) -->
                <div>
                    <label for="instansi" class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
                    <select name="instansi" id="instansi"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:outline-none">
                        <option value="">Pilih Instansi</option>
                        <option value="Kepala Perwakilan">Kepala Perwakilan</option>
                        <option value="Bagian Umum">Bagian Umum</option>
                        <option value="Sub Bagian">Sub Bagian</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Tanggal dan Tujuan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <div class="relative">
                            <input type="date" name="tanggal" id="tanggal"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 pr-10 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:outline-none">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3M16 7V3M4 11h16M5 20h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Tujuan -->
                    <div>
                        <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan Kunjungan</label>
                        <textarea name="tujuan" id="tujuan" placeholder="Masukkan Tujuan Kunjungan" rows="2"
                            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:outline-none resize-none"></textarea>
                    </div>
                </div>

                <!-- Tombol -->
                <div>
                    <button type="submit"
                        class="w-full bg-indigo-900 text-white py-3 rounded-md hover:bg-indigo-800 transition duration-200">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
