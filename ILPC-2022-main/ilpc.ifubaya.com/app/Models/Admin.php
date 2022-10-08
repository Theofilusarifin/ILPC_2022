<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mcContests()
    {
        return $this->hasMany(McContests::class, 'mc_contest_id');
    }

    public function prgContests()
    {
        return $this->hasMany(PrgContest::class, 'prg_contest_id');
    }

    public function essayContests()
    {
        return $this->hasMany(EssayContest::class, 'essay_contest_id');
    }
}
