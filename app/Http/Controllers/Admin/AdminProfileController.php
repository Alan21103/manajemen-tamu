<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminProfileController extends Controller
{
    /**
     * Menampilkan halaman profil admin.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('admin.profile');
    }

    /**
     * Update foto profil admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validasi input untuk gambar profil
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi file gambar
        ]);

        // Ambil data pengguna (admin) yang sedang login
        $admin = Auth::user();

        // Proses upload gambar profil jika ada
        if ($request->hasFile('profile_image')) {
            // Hapus gambar lama jika ada
            if ($admin->profile_image) {
                Storage::delete('public/profile/' . $admin->profile_image);
            }

            // Simpan gambar baru ke folder 'profile' dalam 'public' disk
            $imagePath = $request->file('profile_image')->store('profile', 'public');
            
            // Simpan nama file gambar ke database
            $admin->profile_image = basename($imagePath);
        }

        // Simpan perubahan profil
        $admin->save();

        // Redirect ke halaman profil admin dengan pesan sukses
        return redirect()->route('admin.profile')->with('success', 'Foto profil berhasil diperbarui.');
    }
}
