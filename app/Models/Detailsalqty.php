<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsalqty extends Model
{
    use HasFactory;
    protected $table='master';
    protected $fillable=[
        'tglform',
        'kode',
        'noform',
        'nobatch',
        'qty',
        'ket',
    ];
}