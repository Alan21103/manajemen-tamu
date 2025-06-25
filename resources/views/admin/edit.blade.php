@extends('layouts.app')

@section('content')
<!-- Font Styling -->
@push('head')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
@endpush

<div class="max-w-3xl mx-auto bg-white/80 backdrop-blur-[14px] p-10 rounded-xl shadow-xl border border-[#1B254B]/40 mt-10 font-['DM Sans',sans-serif] mb-10">
  <h2 class="text-4xl font-bold text-[#1B254B] text-center mb-8 tracking-tight leading-tight">
    Edit Data Tamu
  </h2>

  @if(session('success'))
  <div class="bg-green-50 border border-green-300 text-green-800 px-5 py-4 mb-6 rounded-xl shadow">
    {{ session('success') }}
  </div>
  @endif

  @if($errors->any())
  <div class="bg-red-50 border border-red-300 text-red-800 px-5 py-4 mb-6 rounded-xl shadow">
    <ul class="list-disc list-inside space-y-1">
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('admin.tamu.update', $tamu->id) }}" method="POST" class="space-y-6 text-base">
    @csrf
    @method('PUT')

    @php
    $inputClass = 'w-full px-5 py-3 rounded-lg bg-gray-100 border border-[#1B254B] text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#1B254B] transition';
    @endphp

    <div>
      <label class="block font-semibold text-[#1B254B] mb-2">Nama</label>
      <input type="text" name="nama" class="{{ $inputClass }}" value="{{ old('nama', $tamu->nama) }}" required>
    </div>

    <div>
      <label class="block font-semibold text-[#1B254B] mb-2">Tanggal</label>
      <input type="date" name="tanggal" class="{{ $inputClass }}" value="{{ old('tanggal', \Carbon\Carbon::parse($tamu->tanggal)->format('Y-m-d')) }}" required>
    </div>

    <div>
      <label class="block font-semibold text-[#1B254B] mb-2">Instansi</label>
      <input type="text" name="instansi" class="{{ $inputClass }}" value="{{ old('instansi', $tamu->instansi) }}" required>
    </div>

    <div>
      <label class="block font-semibold text-[#1B254B] mb-2">No Telepon</label>
      <input type="text" name="no_telepon" class="{{ $inputClass }}" value="{{ old('no_telepon', $tamu->no_telepon) }}" required>
    </div>

    <div>
      <label class="block font-semibold text-[#1B254B] mb-2">Tujuan Kunjungan</label>
      <textarea name="tujuan_kunjungan" rows="3" class="{{ $inputClass }} resize-none" required>{{ old('tujuan_kunjungan', $tamu->tujuan_kunjungan) }}</textarea>
    </div>

    <div>
      <label class="block font-semibold text-[#1B254B] mb-2">Bidang Tujuan</label>
      @php
      $bidangTerpilih = explode(', ', $tamu->bidang);
      @endphp
      <div class="grid grid-cols-2 gap-3 text-[#1B254B]">
        @foreach(['Kepala Perwakilan', 'Bagian Umum', 'Sub Bagian'] as $bidang)
        <label class="flex items-center gap-2">
          <input type="checkbox" name="bidang[]" value="{{ $bidang }}" class="accent-[#1B254B]" {{ in_array($bidang, $bidangTerpilih) ? 'checked' : '' }}>
          {{ $bidang }}
        </label>
        @endforeach
        <label class="flex items-center gap-2 col-span-2">
          <input type="checkbox" id="lainnya-checkbox" onclick="toggleLainnyaInput()" class="accent-[#1B254B]" {{ collect($bidangTerpilih)->filter(fn($b) => !in_array($b, ['Kepala Perwakilan', 'Bagian Umum', 'Sub Bagian']))->isNotEmpty() ? 'checked' : '' }}>
          Lainnya
        </label>
      </div>
      <input type="text" name="bidang[]" id="lainnya-input" placeholder="Tulis bidang lainnya..." class="mt-3 {{ $inputClass }}" value="{{ collect($bidangTerpilih)->filter(fn($b) => !in_array($b, ['Kepala Perwakilan', 'Bagian Umum', 'Sub Bagian']))->first() }}" style="display: none;">
    </div>

    <div>
      <label class="block font-semibold text-[#1B254B] mb-2">Rating Kunjungan</label>
      <select name="rating" class="{{ $inputClass }}">
        <option value="">Pilih rating</option>
        @for ($i = 1; $i <= 5; $i++)
        <option value="{{ $i }}" {{ old('rating', $tamu->rating) == $i ? 'selected' : '' }}>{{ str_repeat('★', $i) }}</option>
        @endfor
      </select>
    </div>

    <div class="text-right">
      <button type="submit" class="bg-[#1B254B] hover:bg-[#151f3a] text-white px-8 py-3 rounded-lg font-semibold shadow-sm transition duration-300">
        Simpan Perubahan
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
window.onload = toggleLainnyaInput;
</script>
@endsection
