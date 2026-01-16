<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppData extends Model
{
    use HasFactory;

    protected $table = 'app_data';

    protected $fillable = [
        'school_name',
        'school_address',
        'school_phone',
        'school_email',
        'school_logo',
        'headmaster_name',
        'headmaster_nip',
        'school_accreditation',
        'school_npsn',
        'school_vision',
        'school_mission',
    ];

    /**
     * Get app data (singleton pattern - hanya ada 1 record)
     */
    public static function getAppData()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'SMP Negeri 1',
                'school_address' => 'Jl. Pendidikan No. 1',
                'school_phone' => '(021) 12345678',
                'school_email' => 'info@smpn1.sch.id',
                'headmaster_name' => 'Drs. Ahmad Setiawan, M.Pd',
                'headmaster_nip' => '196505101990031002',
                'school_accreditation' => 'A',
                'school_npsn' => '20100001',
                'school_vision' => 'Menjadi sekolah unggulan yang berkarakter, berprestasi, dan berwawasan global.',
                'school_mission' => 'Menyelenggarakan pendidikan berkualitas dengan mengembangkan potensi siswa secara optimal.',
            ]
        );
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute()
    {
        if ($this->school_logo && file_exists(storage_path('app/public/' . $this->school_logo))) {
            return asset('storage/' . $this->school_logo);
        }
        return asset('assets/media/logos/default-dark.svg');
    }
}
