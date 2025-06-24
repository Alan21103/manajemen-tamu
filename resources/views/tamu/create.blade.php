<!DOCTYPE html>
<html>
<head>
    <title>Form Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function toggleLainnyaInput() {
            const lainnyaCheckbox = document.getElementById('lainnya-checkbox');
            const input = document.getElementById('lainnya-input');
            input.style.display = lainnyaCheckbox.checked ? 'block' : 'none';
        }
    </script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Formulir Tamu</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tamu.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Nama</label>
                <input type="text" name="nama" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold">Tanggal</label>
                <input type="date" name="tanggal" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold">Instansi</label>
                <input type="text" name="instansi" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold">No Telepon</label>
                <input type="text" name="no_telepon" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label class="block font-semibold">Tujuan Kunjungan</label>
                <textarea name="tujuan_kunjungan" rows="3" class="w-full border border-gray-300 rounded p-2" required></textarea>
            </div>

            <div>
                <label class="block font-semibold">Bidang Tujuan</label>
                <div class="space-y-2 ml-2">
                    <label><input type="checkbox" name="bidang[]" value="Kepala Perwakilan" class="mr-2">Kepala Perwakilan</label><br>
                    <label><input type="checkbox" name="bidang[]" value="Bagian Umum" class="mr-2">Bagian Umum</label><br>
                    <label><input type="checkbox" name="bidang[]" value="Sub Bagian" class="mr-2">Sub Bagian</label><br>
                    <label><input type="checkbox" id="lainnya-checkbox" onclick="toggleLainnyaInput()">Lainnya</label>
                    <input type="text" name="bidang[]" id="lainnya-input" placeholder="Tulis bidang lainnya..." class="w-full mt-2 border border-gray-300 rounded p-2" style="display: none;">
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</body>
</html>
