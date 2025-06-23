@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-lg mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Formulir Penilaian</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('/rating/form') }}" method="POST">
        @csrf

        <!-- Nama Tamu -->
        <div class="mb-4">
            <label for="tamu_id" class="block font-medium text-gray-700 mb-1">Nama Anda</label>
            <select name="tamu_id" id="tamu_id" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:border-blue-500" required>
                @if($tamuHariIni->isEmpty())
                    <option value="">Tidak ada data tamu hari ini</option>
                @else
                    <option value="">-- Pilih Nama --</option>
                    @foreach ($tamuHariIni as $tamu)
                        <option value="{{ $tamu->id }}">{{ $tamu->nama }} - {{ $tamu->instansi }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <!-- Nilai Rating -->
        <div class="mb-4">
            <label for="nilai" class="block font-medium text-gray-700 mb-1">Nilai Rating</label>
            <select name="nilai" id="nilai" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:border-blue-500" required>
                <option value="">-- Pilih Nilai --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }} - 
                        @if($i == 1) Buruk 
                        @elseif($i == 2) Kurang 
                        @elseif($i == 3) Cukup 
                        @elseif($i == 4) Baik 
                        @elseif($i == 5) Sangat Baik 
                        @endif
                    </option>
                @endfor
            </select>
        </div>

        <!-- Komentar -->
        <div class="mb-4">
            <label for="komentar" class="block font-medium text-gray-700 mb-1">Komentar (opsional)</label>
            <textarea name="komentar" id="komentar" rows="3" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="Tulis komentar Anda..."></textarea>
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg w-full transition duration-200">
                Kirim Penilaian
            </button>
        </div>
    </form>
</div>
@endsection
