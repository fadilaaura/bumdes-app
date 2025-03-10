<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'nomor_hp',
        'rt_rw',
        'jumlah',
        'buktiPembayaran',
        'status',
    ];

    protected $table = 'pembayaran'; // Menentukan nama tabel
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'nik', 'nik');
    }
}