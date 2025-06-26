@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
@endpush

@section('content')
<div class="max-w-3xl mx-auto bg-white/70 backdrop-blur-sm px-4 sm:px-6 lg:px-8 py-8 rounded-xl shadow-xl border border-white/30 mt-10 transition-all duration-300">

    <!-- Header -->
    <header class="bg-blue-900/90 py-6 text-center rounded-md mb-8 shadow-sm">
        <h2 class="text-white text-2xl sm:text-3xl font-serif tracking-wide">Formulir Penilaian</h2>
        <p class="text-white text-sm sm:text-base mt-2 font-light">
            Silakan beri penilaian atas pelayanan kami hari ini.
        </p>
    </header>

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 mb-4 rounded border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('/rating/form') }}" method="POST" class="space-y-6">
        @csrf

        @php
            $borderBlur = "border border-white/40 backdrop-blur-sm";
            $inputClass = "w-full pl-10 py-3 rounded-md bg-gray-200/60 $borderBlur placeholder:text-gray-500 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#1B254B]";
            $selectClass = "w-full py-3 px-3 rounded-md bg-gray-200/60 $borderBlur text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#1B254B]";
        @endphp

        <!-- Nama Tamu -->
        <div>
            <label for="tamu_id" class="block text-[#1B254B] text-sm font-medium mb-1">
                Nama Anda <span class="text-red-600">*</span>
            </label>
            <div class="relative">
<span class="absolute inset-y-0 left-3 flex items-center text-black">
    <i class="fas fa-user"></i>
</span>
                <select name="tamu_id" id="tamu_id" class="{{ $inputClass }}" required>
                    @if($tamuHariIni->isEmpty())
                        <option value="">Tidak ada data tamu hari ini</option>
                    @else
                        <option value="">Pilih Nama</option>
                        @foreach ($tamuHariIni as $tamu)
                            <option value="{{ $tamu->id }}">{{ $tamu->nama }} - {{ $tamu->instansi }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <!-- Nilai Rating -->
        <div>
            <label for="nilai" class="block text-[#1B254B] text-sm font-medium mb-1">
                Nilai Rating <span class="text-red-600">*</span>
            </label>
            <select name="nilai" id="nilai" class="{{ $selectClass }}" required>
                <option value="">Pilih Nilai</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">
                        {{ $i }} -
                        @switch($i)
                            @case(1) Buruk @break
                            @case(2) Kurang @break
                            @case(3) Cukup @break
                            @case(4) Baik @break
                            @case(5) Sangat Baik @break
                        @endswitch
                    </option>
                @endfor
            </select>
        </div>

        <!-- Komentar -->
        <div>
            <label for="komentar" class="block text-[#1B254B] text-sm font-medium mb-1">
                Komentar (opsional)
            </label>
            <textarea name="komentar" id="komentar" rows="3" placeholder="Tulis komentar Anda..."
                class="w-full py-3 px-3 rounded-md bg-gray-200/60 {{ $borderBlur }} text-gray-800 placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#1B254B]"></textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="text-right">
            <button type="submit"
                class="bg-blue-900 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-800 transition duration-200">
                Kirim Penilaian
            </button>
        </div>
    </form>
</div>
@endsection
