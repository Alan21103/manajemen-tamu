<div class="flex min-h-screen bg-gradient-to-br from-blue-50 to-white font-sans relative">

  <!-- Sidebar -->
  <aside id="sidebar"
    class="w-64 bg-gradient-to-b from-blue-950 to-blue-900 text-white px-6 py-8 flex flex-col shadow-2xl border-r border-blue-800 transition-all duration-500 ease-in-out z-20">

    <!-- Logo -->
    <div class="mb-10 text-center">
      <img src="/build/assets/img/footer_logo.png" alt="Logo BPKP" class="w-20 mx-auto mb-3 drop-shadow-md">
      <h1 class="text-sm font-semibold leading-tight text-white/90 tracking-wide">Perwakilan BPKP Daerah<br>Istimewa Yogyakarta</h1>
    </div>

    <!-- Menu -->
    <nav class="flex-1">
      <ul class="space-y-1 text-[15px] text-white/90 font-medium">
        <li>
          <a href="{{ route('dashboard') }}"
            class="group flex items-center gap-4 px-4 py-3 hover:bg-blue-800/50 hover:text-white transition-all relative rounded-lg">
            <span class="absolute left-0 top-0 bottom-0 w-[3px] bg-transparent group-hover:bg-white transition-all"></span>
            <i class="fas fa-home w-5 opacity-80"></i>
            Dashboard
          </a>
        </li>
        <li>
          <a href="{{ route('admin.index') }}"
            class="group flex items-center gap-4 px-4 py-3 hover:bg-blue-800/50 hover:text-white transition-all relative rounded-lg">
            <span class="absolute left-0 top-0 bottom-0 w-[3px] bg-transparent group-hover:bg-white transition-all"></span>
            <i class="fas fa-database w-5 opacity-80"></i>
            Lihat Data
          </a>
        </li>
        <li>
          <a href="{{ route('admin.export.page') }}"
            class="group flex items-center gap-4 px-4 py-3 hover:bg-blue-800/50 hover:text-white transition-all relative rounded-lg">
            <span class="absolute left-0 top-0 bottom-0 w-[3px] bg-transparent group-hover:bg-white transition-all"></span>
            <i class="fas fa-file-export w-5 opacity-80"></i>
            Export Data
          </a>
        </li>
        <li>
          <a href="{{ route('admin.tambahdata') }}"
            class="group flex items-center gap-4 px-4 py-3 hover:bg-blue-800/50 hover:text-white transition-all relative rounded-lg">
            <span class="absolute left-0 top-0 bottom-0 w-[3px] bg-transparent group-hover:bg-white transition-all"></span>
            <i class="fas fa-plus-circle w-5 opacity-80"></i>
            Tambah Data
          </a>
        </li>
        <li>
          <a href="{{ route('admin.profile') }}"
            class="group flex items-center gap-4 px-4 py-3 hover:bg-blue-800/50 hover:text-white transition-all relative rounded-lg">
            <span class="absolute left-0 top-0 bottom-0 w-[3px] bg-transparent group-hover:bg-white transition-all"></span>
            <i class="fas fa-user-cog w-5 opacity-80"></i>
            Profil Admin
          </a>
        </li>
      </ul>
    </nav>

    <!-- Logout -->
    <a href="{{ route('welcome') }}"
      class="mt-8 px-4 py-3 bg-red-500/80 hover:bg-red-600 text-white text-sm font-semibold rounded-lg shadow flex items-center gap-3 justify-center transition-all">
      <i class="fas fa-sign-out-alt"></i> Log Out
    </a>
  </aside>

  <!-- Toggle Button -->
  <button id="toggleSidebarButton"
    class="absolute top-1/2 left-64 transform -translate-y-1/2 bg-white text-blue-900 p-3 rounded-full shadow-md transition-all duration-500 z-30 hover:bg-blue-50 border border-blue-200">
    <i class="fas fa-chevron-left transition-transform duration-300"></i>
  </button>
</div>

<!-- JavaScript Toggle Sidebar -->
<script>
  const toggleBtn = document.getElementById('toggleSidebarButton');
  const sidebar = document.getElementById('sidebar');
  const icon = toggleBtn.querySelector('i');

  let isCollapsed = false;

  toggleBtn.addEventListener('click', () => {
    isCollapsed = !isCollapsed;

    if (isCollapsed) {
      sidebar.classList.add('ml-[-16rem]'); // sembunyikan sidebar
      toggleBtn.classList.remove('left-64');
      toggleBtn.classList.add('left-0');
      icon.classList.remove('fa-chevron-left');
      icon.classList.add('fa-chevron-right');
    } else {
      sidebar.classList.remove('ml-[-16rem]');
      toggleBtn.classList.remove('left-0');
      toggleBtn.classList.add('left-64');
      icon.classList.remove('fa-chevron-right');
      icon.classList.add('fa-chevron-left');
    }
  });
</script>
