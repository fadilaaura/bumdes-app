<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RT extends Model
{
    use HasFactory;

    protected $table = 'rt'; // Pastikan nama tabel sesuai
    protected $primaryKey = 'idRT';
    protected $hidden = [];
    public $timestamps = false;

    protected $fillable = [
        'RTRW',
        'JumlahKK',
        'KetuaRT',
        'Iuran',
    ];
}
