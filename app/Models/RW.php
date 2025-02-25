<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;

    protected $table = 'rw'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'rw',
        'jumlah_kk',
        'ketua_rw',
        'iuran',
    ];
}
