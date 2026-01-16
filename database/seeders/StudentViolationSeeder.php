<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentViolation;
use App\Models\User;
use App\Models\Violation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StudentViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $violations = Violation::all();
        $admin = User::where('role', 'admin')->first();

        if ($students->isEmpty() || $violations->isEmpty() || !$admin) {
            $this->command->warn('Pastikan data Students, Violations, dan Admin sudah ada!');
            return;
        }

        // Buat pelanggaran acak untuk beberapa siswa
        $studentsToViolate = $students->random(min(50, $students->count()));

        foreach ($studentsToViolate as $student) {
            // Random jumlah pelanggaran per siswa (1-5 pelanggaran)
            $violationCount = rand(1, 5);

            for ($i = 0; $i < $violationCount; $i++) {
                $violation = $violations->random();
                $date = Carbon::now()->subDays(rand(0, 60)); // 60 hari terakhir

                // Create violation without triggering model events to control points manually
                StudentViolation::create([
                    'student_id' => $student->id,
                    'violation_id' => $violation->id,
                    'date' => $date,
                    'point' => $violation->point_value,
                    'created_by' => $admin->id,
                ]);
            }
        }

        $this->command->info('Student violations seeded successfully!');
    }
}
