<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $table='riwayat';
    protected $fillable=[
        'tglform',
        'tglsppb',
        'noform',
        'kode',
        'masuk',
        'keluar',
        'saldo',
        'ket',
        'tanggal',
        'adm',
        'suplai',
        'cat',
        'nobatch',
    ];
}