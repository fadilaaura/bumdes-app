<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RW extends Model
{
    use HasFactory;

    protected $table = 'rw'; // Pastikan nama tabel sesuai
    protected $primaryKey = 'idRW';
    protected $hidden = [];
    public $timestamps = false;

    protected $fillable = [
        'RW',
        'JumlahKK',
        'KetuaRW',
        'Iuran',
    ];
}
