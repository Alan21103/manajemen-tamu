<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
     public function index()
    {
        $berita = [];

        $jsonPath = resource_path('content/berita.json');
        if (file_exists($jsonPath)) {
            $decoded = json_decode(file_get_contents($jsonPath), true);
            $berita = is_array($decoded) ? $decoded : [];
        }

        return view('welcome', compact('berita'));
    }

}
