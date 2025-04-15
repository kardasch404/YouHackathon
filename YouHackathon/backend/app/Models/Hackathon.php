<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    use HasFactory;
    
    protected $fillable = 
    [
        'name',
        'description',
    ];


    public function edition ()
    {
        return $this->hasMany(Edition::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
