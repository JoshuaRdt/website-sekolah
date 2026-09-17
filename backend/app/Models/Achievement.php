<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Achievement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul_prestasi',
        'tingkat',
        'nama_siswa',
        'keterangan',
        'gambar_url',
        'tahun',
        'divalidasi_admin',
    ];

    protected $casts = [
        'divalidasi_admin' => 'boolean',
        'tahun' => 'integer',
    ];

    // Scope untuk prestasi yang sudah divalidasi
    public function scopeDivalidasi(Builder $query)
    {
        return $query->where('divalidasi_admin', true)
                    ->orderBy('tahun', 'desc');
    }

    // Scope untuk prestasi berdasarkan tingkat
    public function scopeTingkat(Builder $query,Builder $tingkat)
    {
        return $query->where('tingkat', $tingkat);
    }
}
