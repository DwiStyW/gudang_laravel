<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsal extends Model
{
    use HasFactory;
    protected $table='master';
    protected $fillable=[
        'tgl',
        'nobatch',
        'kode',
        'nopallet',
        'qty',
    ];
}