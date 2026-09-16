<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanteenMenu extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'harga',
        'gambar',
        'rating',
        'terjual',
        'tersedia',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'rating' => 'decimal:1',
        'terjual' => 'integer',
        'tersedia' => 'boolean',
    ];

    // Scope untuk menu yang tersedia
    public function scopeTersedia($query)
    {
        return $query->where('tersedia', true);
    }

    // Scope untuk kategori tertentu
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope untuk menu terpopuler
    public function scopeTerpopuler($query, $limit = 5)
    {
        return $query->orderBy('terjual', 'desc')->limit($limit);
    }
}
