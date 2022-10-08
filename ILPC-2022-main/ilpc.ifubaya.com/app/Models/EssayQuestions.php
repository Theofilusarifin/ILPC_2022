<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayQuestions extends Model
{
    use HasFactory;

    protected $table = 'essay_questions';


    public function essayContest()
    {
        return $this->belongsTo(EssayContests::class, 'essay_contest_id');
    }

}