<?php

namespace Database\Seeders;

use App\Models\Reward;
use App\Models\Student;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get students with 0 points (eligible for rewards)
        $eligibleStudents = Student::where('total_points', 0)->get();

        if ($eligibleStudents->isEmpty()) {
            $this->command->info('Tidak ada siswa dengan 0 poin untuk diberi reward.');
            return;
        }

        $semesters = ['Ganjil 2024/2025', 'Genap 2024/2025', 'Ganjil 2025/2026'];

        $descriptions = [
            'Penghargaan Siswa Teladan - Tidak memiliki catatan pelanggaran selama semester',
            'Sertifikat Kedisiplinan - Mempertahankan catatan bersih sepanjang semester',
            'Piagam Penghargaan - Contoh kedisiplinan bagi siswa lainnya',
            'Medali Kedisiplinan - Prestasi menjaga kedisiplinan',
            'Beasiswa Kedisiplinan - Reward khusus siswa berprestasi tanpa pelanggaran',
        ];

        // Give rewards to random eligible students
        $rewardedStudents = $eligibleStudents->random(min(10, $eligibleStudents->count()));

        foreach ($rewardedStudents as $student) {
            Reward::create([
                'student_id' => $student->id,
                'semester' => $semesters[array_rand($semesters)],
                'description' => $descriptions[array_rand($descriptions)],
            ]);
        }

        $this->command->info('Rewards seeded successfully! ' . $rewardedStudents->count() . ' students rewarded.');
    }
}
