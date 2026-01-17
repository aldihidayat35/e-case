<?php

namespace Database\Seeders;

use App\Models\AppData;
use Illuminate\Database\Seeder;

class AppDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppData::updateOrCreate(
            ['id' => 1],
            [
                'app_name' => 'E-Case',
                'school_name' => 'SMP Negeri 1 Jakarta',
                'school_address' => 'Jl. Pendidikan Raya No. 123, Jakarta Selatan, DKI Jakarta 12345',
                'school_phone' => '(021) 7234567',
                'school_email' => 'info@smpn1jakarta.sch.id',
                'school_logo' => null, // Bisa diupload nanti
                'headmaster_name' => 'Drs. Ahmad Budiman, M.Pd',
                'headmaster_nip' => '196505101990031002',
                'school_accreditation' => 'A',
                'school_npsn' => '20100567',
                'school_vision' => 'Menjadi sekolah menengah pertama yang unggul dalam prestasi, berkarakter mulia, berwawasan lingkungan, dan berorientasi global.',
                'school_mission' => 'Menyelenggarakan pendidikan yang berkualitas dengan mengembangkan potensi akademik dan non-akademik siswa secara optimal, membentuk karakter yang berakhlak mulia, menanamkan kesadaran lingkungan, dan mempersiapkan siswa untuk bersaing di era global.',
            ]
        );

        $this->command->info('✅ Berhasil membuat data aplikasi sekolah');
    }
}
