<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'price',
        'attack',
        'heal',
        'durability',
        'selected',
        'image_path',
    ];

    public function players(){
        return $this->belongsToMany(Player::class, 'inventory', 'item_id', 'player_id')
            ->withPivot(['current_durability', 'selected'])->withTimestamps();
    }
}
