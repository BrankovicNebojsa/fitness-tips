<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Workout extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'workout_duration',
        'difficulty',
        'description',
    ];

    public function exercise() {
        return $this->hasMany(Exercise::class);
    }

    public function equipment() {
        return $this->hasMany(Equipment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}