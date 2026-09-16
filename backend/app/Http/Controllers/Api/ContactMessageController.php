<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // Menyimpan pesan baru dari form kontak
    public function store(Request $request)
    {
        // 1. Validasi data (Best Practice agar database tidak sampah)
        $validated = $request->validate([
            'nama_pengirim' => 'required|string|max:100',
            'email_pengirim' => 'required|email|max:100',
            'subjek' => 'required|string|max:150',
            'pesan' => 'required|string|min:10',
        ]);

        // 2. Simpan ke database
        ContactMessage::create($validated);

        // 3. Kirim respons sukses ke Vue.js
        return response()->json([
            'status' => 'success',
            'message' => 'Terima kasih! Pesan Anda telah terkirim dan akan segera kami baca.'
        ], 201); // 201 adalah kode HTTP untuk "Created"
    }
}
