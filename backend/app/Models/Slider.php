<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Slider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'gambar',
        'judul',
        'deskripsi',
        'teks_tombol_utama',
        'link_tombol_utama',
        'teks_tombol_kedua',
        'link_tombol_kedua',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];

    // Scope untuk mengambil slider yang aktif dan terurut
    public function scopeAktif(Builder $query)
    {
        return $query->where('aktif', true)
                    ->orderBy('urutan', 'asc');
    }
}
