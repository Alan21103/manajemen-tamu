<aside class="w-64 bg-gradient-to-r from-blue-800 to-blue-600 text-white p-6 flex flex-col shadow-md transition-all duration-300 ease-in-out">

    <!-- Sidebar Logo and Title -->
    <div class="mb-10 text-center">
        <img src="/build/assets/img/logo.png" alt="Logo BPKP" class="w-20 mx-auto mb-4">
        <h1 class="text-sm font-semibold">Perwakilan BPKP Daerah<br>Istimewa Yogyakarta</h1>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1">
        <ul class="space-y-4 text-gray-200">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'bg-indigo-600' : 'hover:bg-indigo-500' }} rounded p-3 flex items-center transition-all duration-300 ease-in-out">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>
            
            <!-- Lihat Data -->
            <li>
                <a href="{{ route('admin.index') }}" class="menu-item {{ request()->routeIs('admin.index') ? 'bg-indigo-600' : 'hover:bg-indigo-500' }} rounded p-3 flex items-center transition-all duration-300 ease-in-out">
                    <i class="fas fa-database mr-3"></i> Lihat Data
                </a>
            </li>
            
            <!-- Export Data -->
            <li>
                <a href="{{ route('admin.export.page') }}" class="menu-item {{ request()->routeIs('admin.export-page') ? 'bg-indigo-600' : 'hover:bg-indigo-500' }} rounded p-3 flex items-center transition-all duration-300 ease-in-out">
                    <i class="fas fa-download mr-3"></i> Export Data
                </a>
            </li>
            
            <!-- Tambah Data -->
            <li>
                <a href="{{ route('admin.tambahdata') }}" class="menu-item {{ request()->routeIs('admin.tambahdata') ? 'bg-indigo-600' : 'hover:bg-indigo-500' }} rounded p-3 flex items-center transition-all duration-300 ease-in-out">
                    <i class="fas fa-plus-circle mr-3"></i> Tambah Data
                </a>
            </li>
            
            <!-- Profil Admin -->
            <li>
                <a href="{{ route('admin.profile') }}" class="menu-item {{ request()->routeIs('admin.profile') ? 'bg-indigo-600' : 'hover:bg-indigo-500' }} rounded p-3 flex items-center transition-all duration-300 ease-in-out">
                    <i class="fas fa-user-circle mr-3"></i> Profil Admin
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout Link -->
    <a href="{{ route('welcome') }}" class="text-left mt-4 p-3 text-red-500 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-300 ease-in-out">
        <i class="fas fa-sign-out-alt mr-3"></i> Log Out
    </a>

</aside>

<style>
    .menu-item {
        transition: background-color 0.3s, transform 0.3s ease-in-out;
    }
    .menu-item:hover {
        background-color: rgba(0, 123, 255, 0.6); /* Ganti dengan warna yang lebih terang */
        transform: translateX(5px);
    }
    .menu-item.active {
        background-color: rgba(0, 0, 0, 0.1);
    }
</style>
