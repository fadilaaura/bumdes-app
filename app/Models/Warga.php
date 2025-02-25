<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'kepala_keluarga'; // Pastikan nama tabel sesuai

    protected $fillable = [
        'nama',
        'nik',
        'noTelepon',
        'peranUser',
    ];
}
