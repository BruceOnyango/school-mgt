<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function examResults(): HasMany
    {
        return $this->hasMany(ExamResult::class);
    }
}
