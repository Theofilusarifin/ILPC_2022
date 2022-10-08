<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EssayContests extends Model
{
    use HasFactory;

    protected $table = 'essay_contests';
    protected $fillable = ['nama', 'jadwal_mulai', 'jadwal_selesai', 'admin_id','slug'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_join_essay_contest', 'essay_contest_id', 'team_id')
            ->withPivot(['waktu_bergabung', 'waktu_selesai', 'total_skor', 'submission_filename'])->withTimestamps();
    }

    public function essayQuestions(){
        return $this->hasMany(EssayQuestions::class, 'essay_contest_id');
    }
    

}
