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
    </style>
</head>

<body class="bg-white text-gray-900">

    <!-- Navbar -->
    <header class="flex items-center justify-between px-6 py-4 max-w-[1200px] mx-auto">
        <div class="flex items-center space-x-4">
            <img src="/build/assets/img/logo.png" alt="Logo BPKP" class="w-20 mx-auto mb-4">
            <div class="font-semibold text-sm leading-tight max-w-[180px]">
                <p>Perwakilan BPKP Daerah</p>
                <p>Istimewa Yogyakarta</p>
            </div>
        </div>
        <nav class="hidden md:flex space-x-8 text-sm font-normal text-gray-800">
            <a href="#home" class="hover:underline">Home</a>
            <a href="#struktur" class="hover:underline">Struktur Organisasi</a>
            <a href="#tentang" class="hover:underline">Tentang Kami</a>
            <a href="#berita" class="hover:underline">Berita</a>
        </nav>
        <div class="hidden md:flex space-x-4">
            <a href="{{ url('/login') }}">
                <button
                    class="border border-gray-800 rounded-full px-5 py-1 text-sm font-normal text-gray-800 hover:bg-gray-100">
                    Log in
                </button>
            </a>
        </div>
    </header>

    <!-- Home -->
    <main id="home"
        class="max-w-[1200px] mx-auto px-6 mt-12 md:mt-20 flex flex-col md:flex-row items-center md:items-start justify-between gap-8">
        <section class="max-w-md md:max-w-lg">
            <h1 class="font-extrabold text-4xl md:text-5xl leading-tight mb-6">
                Selamat Datang<br>di BPKP DIY
            </h1>
            <p class="text-sm mb-4 leading-relaxed">
                Bergabunglah dan nikmati solusi pintar yang dirancang untuk memudahkan hidup Anda.
            </p>
            <p class="text-sm mb-8 leading-relaxed">
                Untuk memudahkan anda sebagai tamu langsung saja daftar di form ini.
            </p>
            <a href="{{ url('/form') }}">
                <button class="bg-[#1B254B] text-white font-semibold text-sm rounded-lg px-6 py-3 hover:bg-[#151f3a]">
                    Daftar Tamu
                </button>
            </a>
        </section>
        <section class="flex-shrink-0 max-w-[320px] md:max-w-[400px] text-center">
            <h3 class="text-base font-semibold mb-3">Silakan Scan QR untuk Memberikan Penilaian</h3>

            {{-- Ganti <img> dengan QR code dinamis --}}
            <div class="w-full h-auto flex justify-center">
                {{-- Hardcode sementara untuk pengujian --}}
                {!! QrCode::size(400)->generate('http://10.69.3.141:8000/rating/isi/1') !!}
            </div>
        </section>


    </main>

    <!-- Kinerja Section -->
    <section class="max-w-7xl mx-auto px-6 mt-32 md:mt-40 flex flex-col lg:flex-row lg:space-x-16">
        <!-- Deskripsi -->
        <div class="lg:w-1/2 max-w-xl mb-10 lg:mb-0">
            <h2 class="font-extrabold text-3xl leading-tight mb-4">
                Kinerja BPKP<br>Perwakilan BPKP Daerah<br>Istimewa Yogyakarta
            </h2>
            <p class="text-gray-800 text-[15px] leading-relaxed">
                Jumlah laporan per tahun yang dihasilkan oleh BPKP, termasuk oleh Perwakilan BPKP D.I. Yogyakarta,
                bervariasi tergantung kegiatan, cakupan wilayah, dan fokus tahunan. Namun secara umum dapat mencakup:
            </p>
        </div>

        <!-- Statistik Kinerja -->
        <div class="lg:w-1/2 grid grid-cols-1 md:grid-cols-3 gap-6 text-center text-xs leading-tight">
            <div class="flex flex-col items-center space-y-2 p-4">
                <i class="far fa-chart-bar text-2xl text-blue-600"></i>
                <p>Audit Kinerja dan Audit Dengan Tujuan Tertentu (ADTT):<br><strong>40–60 laporan</strong></p>
            </div>
            <div class="flex flex-col items-center space-y-2 p-4">
                <i class="fas fa-headset text-2xl text-green-600"></i>
                <p>Pendampingan Penyusunan Laporan Keuangan dan Kinerja:<br><strong>± 20–30 output</strong></p>
            </div>
            <div class="flex flex-col items-center space-y-2 p-4">
                <i class="far fa-calendar-alt text-2xl text-orange-600"></i>
                <p>Audit Dana Desa & Evaluasi Program Prioritas Daerah:<br><strong>± 10–15 laporan</strong></p>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi Content -->
    <main id="struktur" class="flex flex-col md:flex-row items-center justify-center px-20 py-16 gap-20">
        <img src="https://storage.googleapis.com/a1aa/image/86bbacd5-4289-4085-9e21-2567bbb34872.jpg"
            alt="Modern office building with glass windows and bpkp logo on the wall"
            class="rounded-3xl w-full max-w-[450px] object-cover transform md:-translate-x-12" height="400" width="400">
        <div class="max-w-xl text-start">
            <h1 class="text-3xl font-bold mb-6 leading-tight text-gray-800">Struktur Organisasi</h1>
            <p class="text-gray-700 text-[15px] leading-relaxed">
                Struktur organisasi BPKP dirancang secara strategis untuk mendukung pelaksanaan tugas dan fungsi
                pengawasan intern pemerintah secara efektif dan efisien. Dengan pembagian peran yang jelas mulai dari
                pimpinan hingga unit-unit kerja teknis, setiap bagian memiliki tanggung jawab spesifik dalam menjamin
                akuntabilitas keuangan negara dan pelaksanaan program pembangunan nasional. Struktur ini mencerminkan
                prinsip tata kelola yang baik (good governance), di mana sinergi antarunit menjadi kunci dalam
                mewujudkan pengawasan yang profesional, independen, dan berorientasi hasil, sesuai dengan nilai-nilai
                PIONIR yang dipegang teguh oleh BPKP.
            </p>
        </div>
    </main>

    <!-- Tentang Kami -->
    <main id="tentang" class="max-w-7xl mx-auto px-6 pb-20">
        <section class="flex flex-col lg:flex-row lg:items-start lg:space-x-16">
            <article class="lg:w-1/2 max-w-xl">
                <h1 class="text-3xl font-extrabold mb-6">Tentang Kami</h1>
                <p class="text-gray-800 text-[15px] leading-relaxed mb-4">
                    Perwakilan BPKP D.I. Yogyakarta adalah bagian dari Badan Pengawasan Keuangan dan Pembangunan (BPKP),
                    lembaga pengawasan intern pemerintah yang berada langsung di bawah Presiden. Berawal dari Djawatan
                    Akuntan Negara sejak 1936, lembaga ini telah mengalami berbagai transformasi kelembagaan hingga
                    resmi menjadi BPKP pada tahun 1983. Sejak itu, kami terus menjalankan peran strategis dalam mengawal
                    akuntabilitas keuangan dan pembangunan nasional maupun daerah.
                </p>
                <p class="text-gray-800 text-[15px] leading-relaxed">
                    Didukung nilai-nilai PIONIR, kami menjalankan fungsi pengawasan secara profesional, independen, dan
                    proaktif melalui kegiatan audit, asistensi, evaluasi, hingga investigasi. Bekerja sama dengan
                    pemerintah daerah dan instansi lainnya, kami berkomitmen mendukung tata kelola pemerintahan yang
                    bersih, transparan, dan efektif demi terwujudnya good governance di wilayah D.I. Yogyakarta.
                </p>
                <div class="flex space-x-12 mt-12">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-map-marked-alt text-2xl text-gray-700"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-[15px]">Location</p>
                            <p class="text-gray-400 text-[14px]">Daerah Istimewa Yogyakarta</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="far fa-envelope text-2xl text-gray-700"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-[15px]">Email</p>
                            <p class="text-gray-400 text-[14px]">yogya@bpkp.go.id</p>
                        </div>
                    </div>
                </div>
            </article>
            <div class="lg:w-1/2 mt-10 lg:mt-0">
                <img src="https://storage.googleapis.com/a1aa/image/8deabc17-2856-4eff-c497-f0abc9c4785a.jpg"
                    alt="Foto kegiatan BPKP" class="w-full rounded-3xl object-cover" height="360" width="720">
            </div>
        </section>
    </main>

    <!-- Berita Terkini -->
    <main id="berita" class="max-w-7xl mx-auto px-6 mt-12 mb-20">
        <h1 class="text-center text-2xl font-extrabold mb-10">Berita Terkini</h1>

        @if (!empty($berita) && is_array($berita) && count($berita) > 0)
            <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($berita as $item)
                    <article class="rounded-xl overflow-hidden shadow-lg">
                        <img src="{{ asset('storage/berita/' . $item['gambar']) }}" alt="Gambar Berita"
                            class="w-full h-[300px] object-cover rounded-t-xl">
                        <div class="bg-[#1B254B] p-4 rounded-b-xl">
                            <h2 class="text-white text-sm font-extrabold leading-tight text-center">
                                {{ $item['judul'] }}
                            </h2>
                        </div>
                    </article>
                @endforeach
            </section>
        @else
            <div class="text-center text-gray-500 text-lg mt-8">
                Konten belum diisi.
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="relative bg-[#1B254B] text-gray-300 pt-16 pb-8 overflow-hidden">
        <svg class="absolute top-0 left-0 w-full h-40 -translate-y-24 md:-translate-y-32" fill="none"
            viewBox="0 0 1440 320">
            <path fill="#1B254B"
                d="M0,224L48,197.3C96,171,192,117,288,117.3C384,117,480,171,576,197.3C672,224,768,224,864,197.3C960,171,1056,117,1152,117.3C1248,117,1344,171,1392,197.3L1440,224L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z" />
        </svg>
        <div class="max-w-7xl mx-auto px-6 relative z-10 flex flex-col md:flex-row justify-between gap-12">
            <div class="max-w-md">
                <img src="https://storage.googleapis.com/a1aa/image/71aa9a22-5281-4b14-6345-01678f1c6752.jpg"
                    alt="BPKP logo" class="w-[80px] h-[40px] object-contain mb-2">
                <p class="font-['Pacifico'] text-lg text-gray-300 mb-6">Hadir Bermanfaat</p>
                <h2 class="text-xl font-semibold text-gray-300 mb-6 leading-snug">
                    Perwakilan BPKP Daerah<br />Istimewa Yogyakarta
                </h2>
                <address class="not-italic text-xs leading-relaxed space-y-3 text-gray-300 max-w-[320px]">
                    <p class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt mt-1"></i>
                        Jl. Parangtritis KM 5,5 Sewon, Kelurahan Bangunharjo, Kecamatan Sewon, Kabupaten Bantul, Daerah
                        Istimewa Yogyakarta 55187
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-phone"></i> (0274) 385323, 445271, Fax. (0274) 415984
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-envelope"></i> yogya@bpkp.go.id
                    </p>
                </address>
            </div>
            <div class="flex flex-col md:items-center md:justify-center space-y-6">
                <h3 class="text-lg font-semibold text-gray-300 mb-2">Sosial Media</h3>
                <div class="flex space-x-8 text-gray-300 text-3xl">
                    <a href="#" class="hover:text-white" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-white" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <p class="text-xs text-gray-400 text-center mt-12 max-w-7xl mx-auto px-6 leading-relaxed">
            Media Komunikasi, Informasi, dan Pengetahuan Pengawas Internal Pemerintah<br />
            © 2023 Badan Pengawasan Keuangan dan Pembangunan
        </p>
    </footer>


</body>

</html>