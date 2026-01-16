<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'nis',
        'name',
        'class_id',
        'total_points',
    ];

    protected $casts = [
        'total_points' => 'integer',
    ];

    /**
     * Get the class of this student
     */
    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    /**
     * Get all violations of this student
     */
    public function violations(): HasMany
    {
        return $this->hasMany(StudentViolation::class);
    }

    /**
     * Get all rewards of this student
     */
    public function rewards(): HasMany
    {
        return $this->hasMany(Reward::class);
    }

    /**
     * Check if student is eligible for reward (0 points)
     */
    public function isEligibleForReward(): bool
    {
        return $this->total_points === 0;
    }

    /**
     * Reset student points to 0
     */
    public function resetPoints(): void
    {
        $this->update(['total_points' => 0]);
    }
}
