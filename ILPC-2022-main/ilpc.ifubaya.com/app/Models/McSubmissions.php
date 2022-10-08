<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McSubmissions extends Model
{
    use HasFactory;

    protected $table = 'mc_submissions';

    public function mcQuestion()
    {
        return $this->belongsTo(McQuestions::class, 'mc_question_id');
    }


}
