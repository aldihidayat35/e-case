<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentViolation extends Model
{
    protected $fillable = [
        'student_id',
        'violation_id',
        'date',
        'point',
        'created_by',
    ];

    protected $casts = [
        'date' => 'date',
        'point' => 'integer',
    ];

    /**
     * Get the student who committed this violation
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the violation type
     */
    public function violation(): BelongsTo
    {
        return $this->belongsTo(Violation::class);
    }

    /**
     * Get the admin who created this record
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically update student total_points when violation is created
        static::created(function ($studentViolation) {
            $student = $studentViolation->student;
            $student->increment('total_points', $studentViolation->point);
        });

        // Automatically update student total_points when violation is deleted
        static::deleted(function ($studentViolation) {
            $student = $studentViolation->student;
            $student->decrement('total_points', $studentViolation->point);
        });
    }
}
