<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisigudang extends Model
{
    use HasFactory;
    protected $table='kondisi_gudang';
    protected $fillable=[
        'ket',
        'posisi',
        'warna',
    ];
}