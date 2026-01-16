<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Violation extends Model
{
    protected $fillable = [
        'name',
        'point_value',
        'description',
    ];

    protected $casts = [
        'point_value' => 'integer',
    ];

    /**
     * Get all student violations records
     */
    public function studentViolations(): HasMany
    {
        return $this->hasMany(StudentViolation::class);
    }
}
