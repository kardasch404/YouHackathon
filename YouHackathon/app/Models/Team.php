<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user ()
    {
        return $this->hasMany(User::class);
    }
    public function edition ()
    {
        return $this->belongsTo(Edition::class);
    }
    public function project ()
    {
        return $this->belongsTo(project::class);
    }
    public function juri()
    {
        return $this->belongsTo(Juri::class);
    }
}
