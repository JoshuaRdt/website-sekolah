<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'visi',
        'misi',
        'sejarah',
        'alamat',
        'telepon',
        'email',
        'website',
        'logo_url',
    ];

    // Helper method untuk mendapatkan data profil
    public static function getInfo()
    {
        return static::firstOrCreate(
            [],
            [
                'nama_sekolah' => 'SMKN 1 Ngawen',
                'visi' => 'MENJADI SEKOLAH VOKASI YANG BERKARAKTER MULIA, BERINTEGRITAS, UNGGUL, DAN BERBUDAYA',
            ]
        );
    }
}
