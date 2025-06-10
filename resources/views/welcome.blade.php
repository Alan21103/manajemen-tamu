@extends('layouts.app')
@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">

            <!-- Tombol Login / Form -->
            <div class="flex justify-end mb-8">
                @auth
                    <a href="{{ url('/form') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Form
                    </a>
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>
                @endauth
            </div>

            <h2 class="text-3xl font-bold text-center mb-12">Berita Terkini</h2>

            @if (!empty($berita) && is_array($berita) && count($berita) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach($berita as $item)
                        <div class="bg-white shadow-md rounded-xl overflow-hidden">
                            <img src="{{ asset('storage/berita/' . $item['gambar']) }}" alt="Gambar Berita"
                                class="w-full h-56 object-cover">
                            <div class="bg-indigo-900 p-4 text-white">
                                <h3 class="font-semibold text-sm leading-snug">{{ $item['judul'] }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-500 text-lg">
                    Konten belum diisi.
                </div>
            @endif
        </div>
    </section>
@endsection