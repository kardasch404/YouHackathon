<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'year',
        'lieu',
        'startDate',
        'endDate',
    ];

    public function team ()
    {
        return $this->hasMany(Team::class);
    }
    public function user ()
    {
        return $this->hasMany(User::class);
    }

    public function hackathon ()
    {
        return $this->belongsTo(Hackathon::class);
    }

}
