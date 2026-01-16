<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            // Kelas X
            'X TO1', 'X TO2', 'X TO3', 'X TKI', 'X TPM',
            // Kelas XI
            'XI TPM', 'XI TKJ', 'XI TKR', 'XI TBSM', 'XI TAB',
            // Kelas XII
            'XII TPM', 'XII TKJ', 'XII TKR', 'XII TBSM', 'XII TAB',
        ];

        foreach ($classes as $class) {
            ClassRoom::firstOrCreate([
                'name' => $class,
            ]);
        }

        $this->command->info('Classes seeded successfully!');
    }
}
