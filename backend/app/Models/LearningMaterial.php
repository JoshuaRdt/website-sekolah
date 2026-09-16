<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningMaterial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'competency_id',
        'judul_materi',
        'file_url',
        'tipe_file',
        'ukuran_file',
    ];

    // Relasi: Materi milik satu kompetensi
    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }

    // Accessor untuk format ukuran file
    public function getUkuranFormattedAttribute()
    {
        $bytes = $this->ukuran_file;
        $units = ['Bytes', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
