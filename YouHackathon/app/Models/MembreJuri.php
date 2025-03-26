<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembreJuri extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'comment',
        'code',
        'password',
    ];

    public function juris()
    {
        return $this->belongsTo(Juri::class);
    }
}
