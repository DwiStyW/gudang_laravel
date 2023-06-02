<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pallet extends Model
{
    use HasFactory;
    protected $table='pallet';
    protected $fillable=[
        'kdpallet',
        'status',
        'qty',
        'posisi',
        'warna',
        'warna2',
    ];
}