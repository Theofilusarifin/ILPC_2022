<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McQuestions extends Model
{
    use HasFactory;

    protected $table = 'mc_questions';

    public function mcContest()
    {
        return $this->belongsTo(McContests::class, 'mc_contest_id');
    }

    public function mcChoices()
    {
        return $this->hasMany(McChoices::class, 'mc_question_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'mc_submissions', 'mc_question_id', 'team_id')
            ->withPivot(['jawaban', 'keyakinan', 'skor'])->withTimestamps();
    }
}
