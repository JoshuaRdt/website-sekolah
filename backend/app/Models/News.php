<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'cuplikan',
        'konten',
        'gambar',
        'tanggal_terbit',
        'dipublikasi',
    ];

    protected $casts = [
        'dipublikasi' => 'boolean',
        'tanggal_terbit' => 'datetime',
    ];

    // Auto-generate slug dari judul
    public static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->judul);
            }
        });
    }

    // Scope untuk berita yang dipublikasi
    public function scopeDipublikasi($query)
    {
        return $query->where('dipublikasi', true)
                    ->orderBy('tanggal_terbit', 'desc');
    }

    // Scope untuk berita berdasarkan kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
