<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayattrack extends Model
{
    use HasFactory;
    protected $table='riwayattrack';
    protected $fillable=[
        'tglform',
        'kode',
        'nobatch',
        'nopallet',
        'statpallet',
        'masuk',
        'keluar',
        'saldo',
        'ket',
        'tanggal',
        'adm',
        'cat',
        'utilisasi',
        'nosppb',
        'noform',
    ];
}
