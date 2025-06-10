@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100 font-sans">
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="flex-1 py-10 px-8 overflow-y-auto">
        <h1 class="text-xl font-bold mb-1">Perwakilan BPKP Daerah Istimewa Yogyakarta</h1>
        <p class="text-sm text-gray-600 mb-6">Dashboard - Manajemen Berita</p>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-semibold mb-6">Tambah Berita Terkini</h2>
            <p class="mb-6 text-gray-500">Silakan isi formulir berikut untuk menambahkan berita</p>

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

            <form action="{{ route('admin.berita.tambah') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Judul Berita -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Masukkan judul berita"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                </div>

                <!-- Gambar Berita -->
                <div>
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar Berita</label>
                    <input type="file" name="gambar" id="gambar" accept="image/*"
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit"
                        class="bg-indigo-900 text-white px-6 py-2 rounded-md hover:bg-indigo-800 transition duration-200">
                        Tambah Berita
                    </button>
                </div>
            </form>
        </div>

    <!-- Daftar Berita -->
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Daftar Berita Terbaru</h2>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach (array_slice($berita, 0, 3) as $i => $item)
                <div class="bg-indigo-900 text-white border border-indigo-900 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                    <div class="relative group">
                        <img src="{{ asset('storage/berita/' . $item['gambar']) }}" alt="Gambar Berita"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-4">
                        <h3 class="text-base font-bold text-white-800 mb-2">{{ $item['judul'] }}</h3>
                        
                        {{-- Jika ada deskripsi --}}
                        @if (!empty($item['deskripsi']))
                            <p class="text-sm text-gray-600 mb-3 line-clamp-3">
                                {{ $item['deskripsi'] }}
                            </p>
                        @endif
                        
                        <form action="{{ route('admin.berita.hapus', $i) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')" class="flex justify-end">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
    class="text-red-500 hover:text-red-700 text-sm flex items-center justify-center">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-3-3v3" />
    </svg>
</button>

                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    </main>
</div>
@endsection
