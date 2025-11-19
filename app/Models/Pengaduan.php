<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Tambahkan ini

class Pengaduan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'deskripsi',
        'lampiran',
        'status',
        'balasan_admin', // Kita tambahkan ini juga untuk nanti
    ];

    /**
     * Mendapatkan user (pelapor) yang memiliki pengaduan ini.
     */
    public function user(): BelongsTo
    {
        // Mendefinisikan relasi ke model User
        return $this->belongsTo(User::class);
    }
}