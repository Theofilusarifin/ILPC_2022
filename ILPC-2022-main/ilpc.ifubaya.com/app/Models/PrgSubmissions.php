<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrgSubmissions extends Model
{
    use HasFactory;

    protected $table = 'prg_submissions';

    public function prgQuestion()
    {
        return $this->belongsTo(PrgQuestions::class, 'prg_question_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
