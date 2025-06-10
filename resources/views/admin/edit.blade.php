@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded shadow mt-6">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Data Tamu</h2>

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

    <form action="{{ route('admin.tamu.update', $tamu->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Nama</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded p-2" value="{{ old('nama', $tamu->nama) }}" required>
        </div>

        <div>
            <label class="block font-semibold">Tanggal</label>
            <input type="date" name="tanggal" class="w-full border border-gray-300 rounded p-2" value="{{ old('tanggal', \Carbon\Carbon::parse($tamu->tanggal)->format('Y-m-d')) }}" required>
        </div>

        <div>
            <label class="block font-semibold">Instansi</label>
            <input type="text" name="instansi" class="w-full border border-gray-300 rounded p-2" value="{{ old('instansi', $tamu->instansi) }}" required>
        </div>

        <div>
            <label class="block font-semibold">No Telepon</label>
            <input type="text" name="no_telepon" class="w-full border border-gray-300 rounded p-2" value="{{ old('no_telepon', $tamu->no_telepon) }}" required>
        </div>

        <div>
            <label class="block font-semibold">Tujuan Kunjungan</label>
            <textarea name="tujuan_kunjungan" rows="3" class="w-full border border-gray-300 rounded p-2" required>{{ old('tujuan_kunjungan', $tamu->tujuan_kunjungan) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Bidang Tujuan</label>
            @php
                $bidangTerpilih = explode(', ', $tamu->bidang);
            @endphp
            <div class="space-y-2 ml-2">
                @foreach(['Kepala Perwakilan', 'Bagian Umum', 'Sub Bagian'] as $bidang)
                    <label><input type="checkbox" name="bidang[]" value="{{ $bidang }}" class="mr-2"
                        {{ in_array($bidang, $bidangTerpilih) ? 'checked' : '' }}> {{ $bidang }}</label><br>
                @endforeach
                <label>
                    <input type="checkbox" id="lainnya-checkbox" onclick="toggleLainnyaInput()" class="mr-2"
                        {{ collect($bidangTerpilih)->filter(fn($b) => !in_array($b, ['Kepala Perwakilan', 'Bagian Umum', 'Sub Bagian']))->isNotEmpty() ? 'checked' : '' }}>
                    Lainnya
                </label>
                <input type="text" name="bidang[]" id="lainnya-input" placeholder="Tulis bidang lainnya..."
                       class="w-full mt-2 border border-gray-300 rounded p-2"
                       value="{{ collect($bidangTerpilih)->filter(fn($b) => !in_array($b, ['Kepala Perwakilan', 'Bagian Umum', 'Sub Bagian']))->first() }}"
                       style="display: none;">
            </div>
        </div>

        <div>
            <label class="block font-semibold">Rating Kunjungan</label>
            <select name="rating" class="w-full border border-gray-300 rounded p-2">
                <option value="">Pilih rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('rating', $tamu->rating) == $i ? 'selected' : '' }}>
                        {{ str_repeat('★', $i) }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>
    </form>
</div>

<script>
    function toggleLainnyaInput() {
        const lainnyaCheckbox = document.getElementById('lainnya-checkbox');
        const input = document.getElementById('lainnya-input');
        input.style.display = lainnyaCheckbox.checked ? 'block' : 'none';
    }

    // Jalankan saat load kalau field "lainnya" sudah ada
    window.onload = toggleLainnyaInput;
</script>
@endsection
