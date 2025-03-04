<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KepalaKeluarga extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'kepala_keluarga';
    protected $primaryKey = 'idKK';
    protected $fillable = ['nik', 'pin', 'email', 'nama', 'alamat', 'noTelepon', 'peranUser', 'RTRW', 'idRW', 'idRT'];

    protected $hidden = [];

    public function getAuthPassword()
    {
        return $this->pin;
    }
}
