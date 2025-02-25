<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PengelolaBumdes extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengelola_bumdes'; // Nama tabel di database
    protected $primaryKey = 'idBUMDes'; // Primary Key

    protected $fillable = [
        'username',
        'password',
        'email',
        'nama',
        'noTelepon',
        'jabatan',
        'foto'
    ];

    protected $hidden = [
        'password',
    ];
}
