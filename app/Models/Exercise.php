<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weight',
        'reps',
        'sets',
        'is_completed',
        'workout_id',
    ];

    // Relationship with Workout
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}