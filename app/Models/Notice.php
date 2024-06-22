<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notice extends Model
{
    use HasFactory;

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'posted_by');
    }
}
