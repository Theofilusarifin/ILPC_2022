<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wave extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor',
        'jadwal_mulai',
        'jadwal_selesai',
        'jadwal_preparasi',
    ];
}
