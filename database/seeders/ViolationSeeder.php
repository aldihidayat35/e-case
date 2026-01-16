<?php

namespace Database\Seeders;

use App\Models\Violation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $violations = [
            ['name' => 'Terlambat Masuk Kelas', 'point_value' => 5, 'description' => 'Datang terlambat masuk kelas tanpa keterangan'],
            ['name' => 'Tidak Memakai Seragam Lengkap', 'point_value' => 10, 'description' => 'Tidak memakai atribut seragam yang lengkap'],
            ['name' => 'Tidak Mengerjakan Tugas', 'point_value' => 5, 'description' => 'Tidak mengumpulkan tugas yang diberikan guru'],
            ['name' => 'Membolos', 'point_value' => 20, 'description' => 'Tidak masuk sekolah tanpa keterangan yang jelas'],
            ['name' => 'Berkelahi', 'point_value' => 50, 'description' => 'Terlibat perkelahian di lingkungan sekolah'],
            ['name' => 'Merokok', 'point_value' => 30, 'description' => 'Merokok di area sekolah'],
            ['name' => 'Tidak Mengikuti Upacara', 'point_value' => 10, 'description' => 'Tidak mengikuti upacara bendera tanpa alasan'],
            ['name' => 'Membawa HP Saat Pembelajaran', 'point_value' => 15, 'description' => 'Menggunakan HP saat proses pembelajaran'],
            ['name' => 'Tidak Sopan ke Guru', 'point_value' => 25, 'description' => 'Berbicara atau bersikap tidak sopan kepada guru'],
            ['name' => 'Merusak Fasilitas Sekolah', 'point_value' => 40, 'description' => 'Merusak properti atau fasilitas milik sekolah'],
            ['name' => 'Rambut Tidak Rapi', 'point_value' => 5, 'description' => 'Potongan rambut tidak sesuai peraturan sekolah'],
            ['name' => 'Tidak Masuk Tanpa Izin', 'point_value' => 15, 'description' => 'Tidak hadir tanpa surat izin dari orang tua'],
        ];

        foreach ($violations as $violation) {
            Violation::firstOrCreate(
                ['name' => $violation['name']],
                [
                    'point_value' => $violation['point_value'],
                    'description' => $violation['description'],
                ]
            );
        }

        $this->command->info('Violations seeded successfully!');
    }
}
