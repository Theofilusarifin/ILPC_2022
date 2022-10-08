<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrgContests extends Model
{
    use HasFactory;

    protected $table = 'prg_contests';

    protected $fillable = ['nama', 'jadwal_mulai', 'jadwal_selesai', 'admin_id', 'slug', 'scoreboard_freeze', 'scoreboard_status', 'scoreboard_slug'];

    protected $casts = [
        'id'   => 'int',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_join_prg_contest', 'prg_contest_id', 'team_id')
            ->withPivot(['waktu_bergabung', 'waktu_selesai', 'total_skor'])->withTimestamps();
            // ->withPivot('waktu_bergabung')->withTimestamps();
    }

    public function prgQuestions()
    {
        return $this->hasMany(PrgQuestions::class, 'prg_contest_id');
    }

    public function activeContest()
    {
        return 'zz';
    }
}
