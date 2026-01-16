<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $namaSiswaLakiLaki = [
            'Ahmad Rizki Pratama',
            'Budi Santoso',
            'Dimas Aditya Nugroho',
            'Fajar Ramadhan',
            'Hendra Wijaya',
            'Irfan Hakim',
            'Joko Susanto',
            'Muhammad Fauzan',
            'Reza Fahlevi',
            'Yoga Permana',
            'Andi Saputra',
            'Doni Setiawan',
            'Eko Prasetyo',
            'Gilang Ramadhan',
            'Hendri Kurniawan',
            'Rizal Maulana',
            'Taufik Hidayat',
            'Wahyu Firmansyah',
            'Yudi Prabowo',
            'Zaki Abdullah',
            'Arief Rahman',
            'Bayu Aji',
            'Dedi Kusuma',
            'Ferry Gunawan',
            'Hadi Suprapto',
            'Imam Syafi\'i',
            'Krisna Wijaya',
            'Lutfi Hakim',
            'Nanda Pratama',
            'Rian Permana'
        ];

        $namaSiswaPerempuan = [
            'Ayu Lestari',
            'Citra Dewi',
            'Dina Maharani',
            'Fitri Handayani',
            'Hana Pertiwi',
            'Intan Permata Sari',
            'Kartika Putri',
            'Linda Wijayanti',
            'Maya Sari',
            'Nur Azizah',
            'Putri Ayu Ningrum',
            'Rina Kurnia',
            'Siti Nurhaliza',
            'Tari Wulandari',
            'Vina Amelia',
            'Wulan Dari',
            'Yuni Astuti',
            'Zahra Azzahra',
            'Anisa Rahma',
            'Bella Safira',
            'Cindy Angelina',
            'Dewi Lestari',
            'Eka Putri',
            'Fitria Rahmawati',
            'Gita Savitri',
            'Hesti Purwaningsih',
            'Indah Sari',
            'Jasmine Puspita',
            'Kirana Larasati',
            'Lala Amira'
        ];

        // Gabungkan semua nama
        $semuaNama = array_merge($namaSiswaLakiLaki, $namaSiswaPerempuan);
        shuffle($semuaNama);

        $classes = ClassRoom::all();

        if ($classes->isEmpty()) {
            $this->command->warn('Tidak ada data kelas. Jalankan ClassSeeder terlebih dahulu!');
            return;
        }

        // Generate NIS starting from 2024001
        $nisCounter = 2024001;

        // Distribusikan siswa ke setiap kelas
        foreach ($semuaNama as $index => $nama) {
            // Pilih kelas secara round-robin agar merata
            $classIndex = $index % $classes->count();
            $class = $classes[$classIndex];

            Student::firstOrCreate(
                ['nis' => (string) $nisCounter],
                [
                    'name' => $nama,
                    'class_id' => $class->id,
                    'total_points' => 0, // Default semua siswa mulai dengan 0 poin
                ]
            );

            $nisCounter++;
        }

        $this->command->info('✅ Berhasil membuat ' . count($semuaNama) . ' data siswa');
        $this->command->info('📊 Total siswa per kelas: ' . ceil(count($semuaNama) / $classes->count()) . ' siswa');
    }
}
