# 🔐 Informasi Login E-Case System

## Admin Account

Gunakan salah satu akun berikut untuk login ke sistem:

### Account 1
- **Email:** `admin@ecase.com`
- **Password:** `password`
- **Role:** Admin

### Account 2
- **Email:** `admin@sekolah.com`
- **Password:** `password`
- **Role:** Admin

## URL Login
- **Development:** http://localhost:8000/login
- **Production:** [Your Production URL]/login

## ⚠️ Setup Awal (WAJIB DIJALANKAN)

Sebelum upload logo atau file pertama kali, jalankan command berikut untuk membuat symbolic link storage:

```bash
php artisan storage:link
```

Command ini membuat symbolic link dari `storage/app/public` ke `public/storage` sehingga file yang diupload dapat diakses public.

## 📁 Upload Logo Sekolah

1. Login sebagai admin
2. Buka menu **Setting Aplikasi** di sidebar
3. Upload logo sekolah pada form yang tersedia
4. Logo akan ditampilkan di:
   - Sidebar admin panel (jika ada)
   - Halaman login
   - Landing page / Home
   - Footer

## Catatan Keamanan
⚠️ **PENTING:** Segera ganti password default setelah login pertama kali di production!

## Troubleshooting Login

Jika login gagal:
1. Pastikan email dan password ditulis dengan benar (case-sensitive untuk password)
2. Clear browser cache dan cookies
3. Pastikan Laravel session berfungsi dengan baik
4. Cek file `.env` untuk konfigurasi `SESSION_DRIVER` dan `SESSION_LIFETIME`

### Reset Password Manual (via Tinker)
```bash
php artisan tinker

# Reset password user
$user = User::where('email', 'admin@ecase.com')->first();
$user->password = 'password_baru';
$user->save();
```

### Atau gunakan command berikut untuk reset semua admin:
```bash
php artisan tinker --execute="
use App\Models\User;
User::find(1)->update(['password' => 'password']);
User::find(2)->update(['password' => 'password']);
echo 'Password reset berhasil!';
"
```

---
Last Updated: 2026-01-15
