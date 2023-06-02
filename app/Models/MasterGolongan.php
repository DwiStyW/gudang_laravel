<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mastergolongan extends Model
{
    use HasFactory;
    protected $table='golongan';
    protected $fillable=[
        'kdgol',
        'namagol',
    ];
}