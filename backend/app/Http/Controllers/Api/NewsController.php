<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Mengambil semua berita yang dipublikasi
    public function index()
    {
        $news = News::where('dipublikasi', true)
                    ->orderBy('tanggal_terbit', 'desc')
                    ->get();

        return response()->json([
            'status' => 'success',
            'data' => $news
        ]);
    }

    // Mengambil detail 1 berita berdasarkan slug (untuk halaman detail nanti)
    public function show($slug)
    {
        $news = News::where('slug', $slug)
                    ->where('dipublikasi', true)
                    ->firstOrFail(); // Akan error 404 jika tidak ditemukan

        return response()->json([
            'status' => 'success',
            'data' => $news
        ]);
    }
}
