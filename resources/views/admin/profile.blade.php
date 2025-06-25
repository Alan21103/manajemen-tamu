@extends('layouts.app')

@section('content')
<!-- Tambahkan CDN FontAwesome jika belum ada di layout -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

<div class="flex min-h-screen bg-gray-100 font-sans">

    <!-- Sidebar -->
    <x-sidebar class="w-64 bg-gray-800 text-white p-6" />

    <!-- Main Content -->
    <main class="flex-1 py-10 px-8 overflow-y-auto">
        <h1 class="text-2xl font-semibold mb-3">Perwakilan BPKP Daerah Istimewa Yogyakarta</h1>
        <p class="text-sm text-gray-600 mb-6">Dashboard - Profil Admin</p>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
                <h2 class="text-xl font-semibold text-gray-800">Profil Admin</h2>
            </div>

            <div class="flex items-center space-x-6 mb-8">
                <div class="relative">
                    <!-- Profile Image -->
                    <img id="profile-image" src="{{ auth()->user()->profile_image ? asset('storage/profile/' . auth()->user()->profile_image) : asset('images/default-profile.jpg') }}" 
                         alt="Admin Profile" class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    
                    <!-- Icon Button for Changing Profile Image -->
                    <label for="profile_image_input" class="absolute bottom-0 right-0 bg-indigo-600 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-700">
                        <i class="fas fa-camera"></i> <!-- Camera Icon -->
                    </label>
                    <input type="file" id="profile_image_input" name="profile_image" accept="image/*" class="hidden" onchange="previewImage(event)">
                </div>
                <div>
                    <h3 class="text-2xl font-semibold">{{ auth()->user()->name }}</h3>
                    <p class="text-lg text-gray-600">{{ auth()->user()->email }}</p>
                    <p class="mt-2 text-sm text-gray-500">Jabatan: <span class="font-semibold">Admin</span></p>
                    <p class="mt-1 text-sm text-gray-500">Status: <span class="font-semibold">Aktif</span></p>
                </div>
            </div>

            <hr class="my-6 border-gray-300">

            <!-- Profile Info Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-user-circle text-indigo-600 text-2xl"></i>
                    <div>
                        <p class="font-medium text-gray-700">Nama</p>
                        <p class="text-gray-500">{{ auth()->user()->name }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <i class="fas fa-envelope text-indigo-600 text-2xl"></i>
                    <div>
                        <p class="font-medium text-gray-700">Email</p>
                        <p class="text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <i class="fas fa-cogs text-indigo-600 text-2xl"></i>
                    <div>
                        <p class="font-medium text-gray-700">Jabatan</p>
                        <p class="text-gray-500">Admin</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <i class="fas fa-calendar-alt text-indigo-600 text-2xl"></i>
                    <div>
                        <p class="font-medium text-gray-700">Bergabung Sejak</p>
                        <p class="text-gray-500">{{ auth()->user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // Function to preview the selected image
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            const output = document.getElementById('profile-image');
            output.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection

