<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nis',
        'kartu_pelajar',
        'kelas',
        'telp_peserta',
        'email',
        'alamat',
        'status',
        'ukuran_baju',
        'alergi',
        'vegetarian',
        'team_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
