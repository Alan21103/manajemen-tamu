<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>BPKP DIY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter&display=swap");

        body {
            font-family: "Inter", sans-serif;
        }

        /* Animasi Slide dari Kiri dan Kanan */
        .slide-in-left {
            animation: slideInLeft 1.5s ease-out;
        }

        .slide-in-right {
            animation: slideInRight 1.5s ease-out;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="bg-white text-gray-900">

    <!-- Navbar -->
    <header class="flex items-center justify-between px-6 py-4 max-w-[1200px] mx-auto slide-in-left">
        <div class="flex items-center space-x-4">
            <img src="/build/assets/img/logo.png" alt="Logo BPKP" class="w-20 mx-auto mb-4 transition-all duration-300 ease-in-out">
            <div class="font-semibold text-sm leading-tight max-w-[180px]">
                <p>Perwakilan BPKP Daerah</p>
                <p>Istimewa Yogyakarta</p>
            </div>
        </div>
        <nav class="hidden md:flex space-x-8 text-sm font-normal text-gray-800 transition-all duration-300 ease-in-out slide-in-left">
            <a href="#home" class="hover:underline transition-all duration-300 ease-in-out">Home</a>
            <a href="#struktur" class="hover:underline transition-all duration-300 ease-in-out">Struktur Organisasi</a>
        </nav>
        <div class="hidden md:flex space-x-4">
            <a href="{{ url('/login') }}">
                <button class="border border-gray-800 rounded-full px-5 py-1 text-sm font-normal text-gray-800 hover:bg-gray-100 transition-all duration-300 ease-in-out slide-in-right">
                    Log in
                </button>
            </a>
        </div>
    </header>

    <!-- Home -->
    <main id="home"
        class="max-w-[1200px] mx-auto px-6 mt-12 md:mt-20 flex flex-col md:flex-row items-center md:items-start justify-between gap-8 slide-in-left">
        <section class="max-w-md md:max-w-lg">
            <h1 class="font-[Lora] text-7xl md:text-8xl leading-tight mb-6 text-[#1B254B] font-semibold transform transition-all duration-300 ease-in-out hover:scale-105 hover:text-[#151f3a] mt-12">
                Selamat Datang <span class="font-bold">di BPKP DIY</span>
            </h1>
            <a href="{{ url('/form') }}">
                <button class="bg-[#1B254B] text-white font-semibold text-lg rounded-lg px-10 py-4 hover:bg-[#151f3a] transition-all duration-300 ease-in-out">
                    Buku Tamu
                </button>
            </a>
        </section>
        <section class="flex-shrink-0 max-w-[320px] md:max-w-[400px] text-center">
            <h3 class="text-base font-semibold mb-3">Silakan Scan QR untuk Memberikan Penilaian</h3>

            {{-- Ganti <img> dengan QR code dinamis --}}
            <div class="w-full h-auto flex justify-center">
                {{-- Hardcode sementara untuk pengujian --}}
                {!! QrCode::size(500)->generate('http://10.69.3.141:8000/rating/isi/1') !!}
            </div>
        </section>
    </main>


<!-- Struktur Organisasi Content -->
    <main id="struktur" class="flex flex-col items-center justify-center px-6 py-16 slide-in-right mt-32"> <!-- Changed mt-24 to mt-32 here for more margin -->
        <!-- Judul Besar -->
        <h1 class="font-[Lora] text-6xl md:text-7xl leading-tight mb-6 text-[#1B254B] font-semibold transform transition-all duration-300 ease-in-out hover:scale-105 hover:text-[#151f3a]">
            Struktur Organisasi
        </h1>

        <!-- Gambar yang Besar dan Mengisi Halaman -->
        <div class="flex justify-center w-full mb-8">
            <img src="/build/assets/img/struktur_organisasi.jpg" 
                alt="Modern office building with glass windows and bpkp logo on the wall"
                class="rounded-2xl max-w-7xl w-full h-auto object-contain">
        </div>
    </main>

<!-- Footer -->
<footer class="bg-[#1B254B] text-gray-300 pt-12 pb-6 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-12">
        <!-- Left section: Logo and contact information -->
        <div class="flex flex-col items-center md:items-start space-y-6">
            <img src="/build/assets/img/logo.png" alt="BPKP Logo" class="w-[80px] h-[40px] mb-4">
            <p class="text-2xl font-semibold text-center md:text-left">Hadir Bermanfaat</p>
            <h2 class="text-lg font-bold text-gray-300 text-center md:text-left">Perwakilan BPKP Daerah<br />Istimewa Yogyakarta</h2>
            
            <address class="text-sm text-gray-300 text-center md:text-left">
                <p><i class="fas fa-map-marker-alt mr-2"></i> Jl. Parangtritis KM 5,5 Sewon, Kelurahan Bangunharjo, Kecamatan Sewon, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55187</p>
                <p><i class="fas fa-phone mr-2"></i> (0274) 385323, 445271, Fax. (0274) 415984</p>
                <p><i class="fas fa-envelope mr-2"></i> <a href="mailto:yogya@bpkp.go.id" class="text-gray-300 hover:text-white">yogya@bpkp.go.id</a></p>
            </address>
        </div>

        <!-- Right section: Social Media Links and Other Info -->
        <div class="flex flex-col items-center space-y-6">
            <h3 class="text-xl font-semibold text-gray-300">Sosial Media</h3>
            <div class="flex space-x-6 text-gray-300 text-3xl">
                <a href="#" class="hover:text-white" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="#" class="hover:text-white" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-white" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" class="hover:text-white" aria-label="X"><i class="fab fa-x"></i></a>
                <a href="#" class="hover:text-white" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </div>

    <!-- Bottom section: Privacy Policy and Complaint Channel -->
    <div class="text-center mt-6">
        <a href="#" class="text-sm text-gray-300 hover:text-white">Kebijakan Privasi</a> | 
        <a href="#" class="text-sm text-gray-300 hover:text-white">Kanal Pengaduan</a>
    </div>

    <!-- Footer Bottom text -->
    <p class="text-xs text-gray-400 text-center mt-6 max-w-7xl mx-auto px-6 leading-relaxed">
        Media Komunikasi, Informasi, dan Pengetahuan Pengawas Internal Pemerintah<br />
        © 2023 Badan Pengawasan Keuangan dan Pembangunan
    </p>
</footer>




</body>

</html>
