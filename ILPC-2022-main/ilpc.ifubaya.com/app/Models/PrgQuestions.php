<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PrgQuestions extends Model
{
    use HasFactory;

    protected $table = 'prg_questions';

    public function prgContest()
    {
        return $this->belongsTo(PrgContests::class, 'prg_contest_id');
    }

    public function prgSubmissions(){
        return $this->hasMany(PrgSubmissions::class, 'prg_question_id');
    }
}
