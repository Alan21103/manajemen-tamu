@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Manajemen Berita Terkini</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.berita.tambah') }}" method="POST" enctype="multipart/form-data" class="mb-8 space-y-4 bg-white p-6 rounded shadow">
        @csrf
        <div>
            <label class="block font-medium">Judul Berita</label>
            <input type="text" name="judul" required class="w-full border border-gray-300 p-2 rounded">
        </div>
        <div>
            <label class="block font-medium">Gambar Berita</label>
            <input type="file" name="gambar" accept="image/*" required class="block">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Berita</button>
    </form>

    <h2 class="text-xl font-semibold mb-4">Daftar Berita</h2>
    <div class="grid gap-6 md:grid-cols-3">
        @foreach (array_slice($berita, 0, 3) as $i => $item)
            <div class="border rounded overflow-hidden shadow bg-white">
                <img src="{{ asset('storage/berita/' . $item['gambar']) }}" class="w-full h-40 object-cover">
                <div class="p-3">
                    <p class="font-semibold text-sm mb-2">{{ $item['judul'] }}</p>
                    <form action="{{ route('admin.berita.hapus', $i) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
