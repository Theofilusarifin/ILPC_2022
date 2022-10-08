<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    use HasFactory;

    public function robot()
    {
        return $this->belongsTo(Robot::class, 'robot_id');
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'territory_id');
    }
}
