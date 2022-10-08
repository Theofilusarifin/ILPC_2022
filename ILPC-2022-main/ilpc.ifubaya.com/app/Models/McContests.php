<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McContests extends Model
{
    use HasFactory;

    protected $table = 'mc_contests';

    protected $fillable = ['nama', 'jadwal_mulai', 'jadwal_selesai', 'admin_id','slug'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_join_mc_contest', 'mc_contest_id', 'team_id')
            ->withPivot(['waktu_bergabung', 'waktu_selesai','total_skor'])->withTimestamps();
    }

    public function mcQuestions(){
        return $this->hasMany(McQuestions::class, 'mc_contest_id');
    }
}
