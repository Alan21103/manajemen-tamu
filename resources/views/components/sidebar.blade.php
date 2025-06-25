<div class="flex min-h-screen bg-gray-100 font-sans relative">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="w-64 bg-gradient-to-r from-blue-800 to-blue-600 text-white p-6 flex flex-col shadow-md transition-all duration-300 ease-in-out">
        <!-- Sidebar Logo and Title -->
        <div class="mb-10 text-center">
            <img src="/build/assets/img/logo.png" alt="Logo BPKP" class="w-20 mx-auto mb-4">
            <h1 class="text-sm font-semibold">Perwakilan BPKP Daerah<br>Istimewa Yogyakarta</h1>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1">
            <ul class="space-y-4 text-gray-200">
                <li><a href="{{ route('dashboard') }}" class="menu-item rounded p-3 flex items-center">Dashboard</a>
                </li>
                <li><a href="{{ route('admin.index') }}" class="menu-item rounded p-3 flex items-center">Lihat Data</a>
                </li>
                <li><a href="{{ route('admin.export.page') }}" class="menu-item rounded p-3 flex items-center">Export
                        Data</a></li>
                <li><a href="{{ route('admin.tambahdata') }}" class="menu-item rounded p-3 flex items-center">Tambah
                        Data</a></li>
                <li><a href="{{ route('admin.profile') }}" class="menu-item rounded p-3 flex items-center">Profil
                        Admin</a></li>
            </ul>
        </nav>

        <!-- Logout Link -->
        <a href="{{ route('welcome') }}"
            class="text-left mt-4 p-3 text-red-500 hover:bg-red-600 hover:text-white rounded-lg">Log Out</a>
    </aside>

    <!-- Button to toggle sidebar -->
    <button id="toggleSidebarButton"
        class="absolute top-1/2 left-0 z-10 p-2 bg-indigo-600 text-white rounded-full shadow-lg hover:bg-indigo-700 transition-all duration-300 transform -translate-y-1/2">
        <i class="fas fa-chevron-right"></i> <!-- Toggle icon (initially for hidden state) -->
    </button>

</div>

<style>
    .menu-item {
        transition: background-color 0.3s, transform 0.3s ease-in-out;
    }

    .menu-item:hover {
        background-color: rgba(0, 123, 255, 0.6);
        /* Ganti dengan warna yang lebih terang */
        transform: translateX(5px);
    }

    #sidebar {
        transition: transform 0.3s ease;
        transform: translateX(0);
        /* Sidebar muncul dengan posisi normal */
    }

    #sidebar.hidden {
        transform: translateX(-100%);
        /* Sidebar tersembunyi */
    }

    #toggleSidebarButton {
        width: 40px;
        /* Menetapkan lebar tombol agar lebih ramping */
        height: 40px;
        /* Menetapkan tinggi tombol */
        padding: 0;
        /* Menghapus padding internal */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #toggleSidebarButton i {
        font-size: 18px;
        /* Mengurangi ukuran ikon */
    }

    #toggleSidebarButton:hover {
        background-color: #4C51BF;
        /* Efek hover untuk memberikan feedback */
    }
</style>

<script>
    document.getElementById('toggleSidebarButton').addEventListener('click', function () {
        var sidebar = document.getElementById('sidebar');
        var toggleButton = document.getElementById('toggleSidebarButton');
        var icon = document.querySelector('#toggleSidebarButton i');

        // Toggle sidebar visibility
        sidebar.classList.toggle('hidden');

        // Change the icon dynamically based on sidebar visibility
        if (sidebar.classList.contains('hidden')) {
            icon.classList.remove('fa-chevron-right');
            icon.classList.add('fa-chevron-left');
            toggleButton.style.left = '0'; // Move the button to the left side when sidebar is hidden
        } else {
            icon.classList.remove('fa-chevron-left');
            icon.classList.add('fa-chevron-right');
            toggleButton.style.left = '240px'; // Set back the button to its initial position when sidebar is shown
        }

        // Adjust main content margin when sidebar is hidden
        var mainContent = document.getElementById('mainContent');
        mainContent.classList.toggle('ml-64');
    });
</script>