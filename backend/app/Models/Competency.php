<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Competency extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'prospek_karir',
        'gambar',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'prospek_karir' => 'array', // JSON akan otomatis diubah ke array
    ];

    // Auto-generate slug
    public static function boot()
    {
        parent::boot();

        static::creating(function ($competency) {
            if (empty($competency->slug)) {
                $competency->slug = Str::slug($competency->nama);
            }
        });
    }

    // Relasi: Satu kompetensi punya banyak materi
    public function learningMaterials()
    {
        return $this->hasMany(LearningMaterial::class);
    }

    // Scope untuk kompetensi yang aktif
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}
