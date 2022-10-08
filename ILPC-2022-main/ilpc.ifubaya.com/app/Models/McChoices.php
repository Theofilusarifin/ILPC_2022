<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McChoices extends Model
{
    use HasFactory;

    protected $table = 'mc_choices';

    
    public function mcQuestion()
    {
        return $this->belongsTo(McQuestions::class, 'mc_question_id');
    }
}

