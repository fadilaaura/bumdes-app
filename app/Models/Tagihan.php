<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan'; // Pastikan tabelnya sesuai
    protected $primaryKey = 'idTagihan';
    protected $fillable = [
        'nama',
        'nik',
        'nomor_hp',
        'rt_rw',
        'jumlah',
        'statusTagihan',
        'tanggalPembuatan',
        'tanggalJatuhTempo'
    ];
        
    public function pembayaran(){
        return $this->hasOne(Pembayaran::class, 'nik', 'nik');
    }
}
