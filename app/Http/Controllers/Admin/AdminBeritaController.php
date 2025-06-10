<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBeritaController extends Controller
{
    private $jsonPath = 'resources/content/berita.json';

    public function index()
    {
        $berita = file_exists(base_path($this->jsonPath))
            ? json_decode(file_get_contents(base_path($this->jsonPath)), true)
            : [];

        return view('admin.konten', compact('berita'));
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048'
        ]);

        $file = $request->file('gambar')->store('berita', 'public');

        $berita = file_exists(base_path($this->jsonPath))
            ? json_decode(file_get_contents(base_path($this->jsonPath)), true)
            : [];

        $berita[] = [
            'judul' => $request->judul,
            'gambar' => basename($file)
        ];

        file_put_contents(base_path($this->jsonPath), json_encode($berita, JSON_PRETTY_PRINT));

        return back()->with('success', 'Berita berhasil ditambahkan.');
    }

    public function hapus($index)
    {
        $berita = json_decode(file_get_contents(base_path($this->jsonPath)), true);

        if (isset($berita[$index])) {
            unset($berita[$index]);
            $berita = array_values($berita); // reindex
            file_put_contents(base_path($this->jsonPath), json_encode($berita, JSON_PRETTY_PRINT));
        }

        return back()->with('success', 'Berita berhasil dihapus.');
    }
}
