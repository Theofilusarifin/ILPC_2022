<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    public function teams()
    {
        return $this->hasMany(Team::class, 'competition_id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'competition_id');
    }
}
