<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reward extends Model
{
    protected $fillable = [
        'student_id',
        'semester',
        'description',
    ];

    /**
     * Get the student who received this reward
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
