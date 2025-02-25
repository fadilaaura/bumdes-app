<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $table = 'rt'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'rt_rw',
        'jumlah_kk',
        'ketua_rt',
        'iuran',
    ];
}
