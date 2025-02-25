<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfirmasiIuran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran'; // Sesuaikan dengan nama tabel di database
}
