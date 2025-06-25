<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Badan Pengawasan Keuangan dan Pembangunan Perwakilan DIY</title>
    <link rel="icon" type="image/png" href="/build/assets/img/footer_logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    
    <!-- Include both fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">

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
</head>

<body class="bg-white text-gray-900">

<!-- Navbar -->
<header class="flex items-center justify-between px-6 py-4 max-w-[1200px] mx-auto slide-in-left sticky top-0 z-50 bg-transparent">
    <div class="flex items-center space-x-4">
        <img src="/build/assets/img/logo_remove.png" alt="Logo BPKP" class="w-90 h-10 transition-all duration-300 ease-in-out">
        <div class="font-semibold text-sm leading-tight">
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
            <button class="border border-blue-900 rounded-full px-5 py-1 text-sm font-normal text-white bg-blue-900 hover:bg-blue-800 transition-all duration-300 ease-in-out slide-in-right">
                Log in
            </button>
        </a>
    </div>
</header>

<!-- Home -->
<main id="home"
    class="max-w-[1200px] mx-auto px-6 mt-12 md:mt-20 flex flex-col md:flex-row items-center md:items-start justify-between gap-8 slide-in-left">
    <section class="max-w-md md:max-w-lg">
        <h1 class="font-[Lora] text-5xl md:text-8xl leading-tight mb-6 text-[#1B254B] font-semibold transform transition-all duration-300 ease-in-out hover:scale-105 hover:text-[#151f3a] mt-12">
            Selamat Datang <span class="font-bold">di BPKP DIY</span>
        </h1>
        <p class="text-[15px] text-gray-600 mb-6">
            Selamat datang di website resmi Perwakilan BPKP Daerah Istimewa Yogyakarta. Di sini, Anda dapat mengakses berbagai informasi mengenai pengawasan keuangan dan pembangunan di wilayah DIY, serta memberikan penilaian atas pelayanan kami.
        </p>
        <a href="{{ url('/form') }}">
            <button class="bg-[#1B254B] text-white font-semibold text-lg rounded-lg px-10 py-4 hover:bg-[#151f3a] transition-all duration-300 ease-in-out">
                Buku Tamu
            </button>
        </a>
    </section>
    <section class="flex-shrink-0 max-w-[320px] md:max-w-[400px] text-center">
        <h3 class="text-base font-semibold mb-3">Silakan Scan QR untuk Memberikan Penilaian</h3>
        <div class="w-full h-auto flex justify-center">
            {!! QrCode::size(500)->generate('http://10.69.3.141:8000/rating/isi/1') !!}
        </div>
    </section>
</main>

<!-- Struktur Organisasi Content -->
<main id="struktur" class="flex flex-col items-center justify-center px-6 py-16 slide-in-right mt-32">
    <h1 class="font-[Lora] text-6xl md:text-5xl leading-tight mb-6 text-[#1B254B] font-bold transform transition-all duration-300 ease-in-out hover:scale-105 hover:text-[#151f3a]">
        Struktur Organisasi
    </h1>
    <div class="flex justify-center w-full mb-8">
        <img src="/build/assets/img/struktur_organisasi.jpg" 
            alt="Modern office building with glass windows and bpkp logo on the wall"
            class="rounded-2xl max-w-7xl w-full h-auto object-contain">
    </div>
</main>

<footer class="bg-[#1B254B] text-gray-300 py-10">
  <div class="w-full flex flex-col md:flex-row justify-between items-start px-8 gap-8">
    <div class="flex flex-col items-start text-left">
        <img src="/build/assets/img/footer_logo.png" alt="BPKP Logo" class="w-[180px] mb-2" />
        <p class="text-2xl text-white font-bold" style="font-family: 'Dancing Script', cursive;">
            Hadir Bermanfaat
        </p>
    </div>

    <div class="flex-1 flex flex-col items-start text-left">
        <h2 class="text-2xl font-bold text-white mb-2">
            Perwakilan BPKP Daerah Istimewa Yogyakarta
        </h2>
        <address class="not-italic text-sm text-gray-300 leading-relaxed space-y-2">
            <p><i class="fas fa-map-marker-alt mr-2"></i>Jl. Parangtritis KM 5,5 Sewon, Bangunharjo, Sewon, Bantul, Yogyakarta 55187</p>
            <p><i class="fas fa-phone mr-2"></i>087700606969</p>
            <p><i class="fas fa-envelope mr-2"></i>
                <a href="mailto:yogya@bpkp.go.id" class="hover:text-white">yogya@bpkp.go.id</a>
            </p>
            <p>
                <a href="https://bpkp.go.id/id/unitKerja/25" class="flex items-center hover:text-white">
                    <i class="fas fa-globe mr-2"></i> Website BPKP
                </a>
            </p>
        </address>
    </div>

    <div class="flex flex-col items-center text-center relative top-[-6px]">
        <h2 class="text-2xl font-bold text-white mb-3">
            Sosial Media
        </h2>
        <div class="flex space-x-4 justify-center">
            <a href="https://www.instagram.com/bpkp_diy?igsh=MXZ2OGl4cmo2dnY1bg==" 
                target="_blank" 
                rel="noopener noreferrer" 
                class="hover:text-white transition duration-300 ease-in-out">
                <i class="fab fa-instagram fa-3x"></i>
            </a>
            <a href="https://www.youtube.com/@bpkpdiy891" 
                target="_blank" 
                rel="noopener noreferrer" 
                class="hover:text-white transition duration-300 ease-in-out">
                <i class="fab fa-youtube fa-3x"></i>
            </a>
        </div>
    </div>
  </div>

  <p class="text-xs text-gray-400 text-center mt-4 max-w-7xl mx-auto px-6 leading-relaxed">
    Media Komunikasi, Informasi, dan Pengetahuan Pengawas Internal Pemerintah<br />
    © 2023 Badan Pengawasan Keuangan dan Pembangunan
  </p>
</footer>

</body>

</html>
