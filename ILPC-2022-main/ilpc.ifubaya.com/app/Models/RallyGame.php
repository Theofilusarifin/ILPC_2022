<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RallyGame extends Model
{
    use HasFactory;

    protected $table = 'rally_games';

    protected $fillable = ['name'];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'rg_score', 'rally_game_id', 'team_id')
            ->withPivot(['score'])->withTimestamps();
    }
}
