<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juri extends Model
{
    use HasFactory;

    public function team ()
    {
        return $this->hasMany(Team::class);
    }
    public function membreJuri ()
    {
        return $this->hasMany(MembreJuri::class);
    }

}
