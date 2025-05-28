@extends('layouts.app')

@section('content')
<div class="p-6 w-full">
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-6">Tambah Data</h2>
        <p class="mb-6 text-gray-500">Tolong isi form di bawah ini</p>

        <form action="{{ route('tamu.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan Nama"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none">
            </div>

            <!-- Instansi -->
            <div>
                <label for="instansi" class="block text-sm font-medium text-gray-700 mb-1">Instansi</label>
                <input type="text" name="instansi" id="instansi" placeholder="Masukkan Nama Instansi"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none">
            </div>

            <!-- Tanggal dan Tujuan Kunjungan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none">
                </div>

                <!-- Tujuan -->
                <div>
                    <label for="tujuan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan Kunjungan</label>
                    <textarea name="tujuan" id="tujuan" placeholder="Masukkan Tujuan Kunjungan" rows="2"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-purple-600 focus:outline-none resize-none"></textarea>
                </div>
            </div>

            <!-- Tombol -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-900 text-white py-3 rounded-md hover:bg-indigo-800 transition duration-200">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection
