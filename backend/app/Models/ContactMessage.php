<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ContactMessage extends Model
{
    protected $fillable = [
        'nama_pengirim',
        'email_pengirim',
        'subjek',
        'pesan',
        'sudah_dibaca',
    ];

    protected $casts = [
        'sudah_dibaca' => 'boolean',
    ];

    // Scope untuk pesan yang belum dibaca
    public function scopeBelumDibaca($query)
    {
        return $query->where('sudah_dibaca', false)
                    ->orderBy('created_at', 'desc');
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update(['sudah_dibaca' => true]);
    }
}
