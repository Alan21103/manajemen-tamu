<aside class="w-64 bg-white shadow-md p-4 flex flex-col">
    <div class="mb-10">
        <img src="/build/assets/img/logo.png" alt="Logo BPKP" class="w-20 mx-auto mb-4">
        <h1 class="text-center text-sm font-semibold">Perwakilan BPKP Daerah<br>Istimewa Yogyakarta</h1>
    </div>
    <nav class="flex-1">
        <ul class="space-y-4 text-gray-700">
            <li class="bg-gray-200 rounded p-2">Dashboard</li>
            <li>
                <a href="{{ route('admin.index') }}" class="hover:bg-gray-100 rounded p-2 block">Lihat Data</a>
            </li>
            <li class="hover:bg-gray-100 rounded p-2">Tambah Data</li>
        </ul>
    </nav>
    <button class="text-left mt-4 p-2 text-red-500 hover:underline">Log Out</button>
</aside>