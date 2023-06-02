<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    use HasFactory;
    protected $table='master';
    protected $fillable=[
        'kode',
        'nama',
        'ukuran',
        'sat1',
        'max1',
        'sat2',
        'max2',
        'sat3',
        'kdgol',
        'kdjenis',
        'tgl_dibuat',
        'expdate',
        'saldo',
        'saldo_track',
        'tglform',
        'tgl_update',
        'min_stock',
        'sisa_kemasan',
    ];
}