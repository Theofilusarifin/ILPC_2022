<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    public function items(){
        return $this->belongsToMany(Item::class, 'inventory', 'player_id', 'item_id')
            ->withPivot(['current_durability', 'selected'])->withTimestamps();
    }

    public function territory()
    {
        return $this->belongsTo(Territory::class, 'territory_id');
    }

    public function team(){
        return $this->belongsTo(Team::class, 'team_id');
    }
}
