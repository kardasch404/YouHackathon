<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
    'title',        
    'description',        
    'lien',        
    ];

    public function team ()
    {
        return $this->hasOne(Team::class);
    }
}
