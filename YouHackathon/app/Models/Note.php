<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'score',
        'comment'
    ];

    public function membreJuris()
    {
        return $this->belongsTo(MembreJuri::class);
    }

    public function teams()
    {
        return $this->hasOne(Team::class);
    }
}
