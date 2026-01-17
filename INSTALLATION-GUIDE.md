# 📖 Panduan Instalasi E-Case

Panduan lengkap untuk setup aplikasi E-Case (Sistem Informasi Pelanggaran Siswa) di environment baru.

---

## 📋 Requirements

Pastikan sistem Anda memiliki:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **MySQL** >= 8.0 atau **MariaDB** >= 10.3
- **Node.js** >= 18.x & **NPM** >= 9.x
- **Git** (untuk clone repository)
- **Web Server**: Apache atau Nginx

---

## 🚀 Langkah Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/aldihidayat35/e-case.git
cd e-case
```

### 2. Install Dependencies

#### Install PHP Dependencies
```bash
composer install
```

#### Install Node Dependencies (Opsional - jika ada frontend build)
```bash
npm install
```

### 3. Setup Environment

#### Copy file .env
```bash
cp .env.example .env
```

#### Edit file .env
Buka file `.env` dan sesuaikan konfigurasi database:

```env
APP_NAME="E-Case"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_case
DB_USERNAME=root
DB_PASSWORD=

# Sesuaikan dengan kredensial database Anda
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Setup Database

#### Buat Database Baru
Buka MySQL/MariaDB dan buat database:

```sql
CREATE DATABASE e_case CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Jalankan Migration
```bash
php artisan migrate
```

#### Jalankan Seeder (Data Awal)
```bash
php artisan db:seed
```

Seeder akan membuat:
- ✅ Admin default
- ✅ Data kelas
- ✅ Data siswa sample
- ✅ Data jenis pelanggaran
- ✅ Data pelanggaran siswa
- ✅ Data penghargaan
- ✅ App data/settings

### 6. Setup Storage Symlink

**PENTING:** Symlink diperlukan agar file yang diupload dapat diakses publik.

#### Windows (Command Prompt as Administrator)
```bash
php artisan storage:link
```

Atau secara manual:
```bash
mklink /D "C:\path\to\e-case\public\storage" "C:\path\to\e-case\storage\app\public"
```

#### Linux/Mac
```bash
php artisan storage:link
```

Atau secara manual:
```bash
ln -s ../storage/app/public public/storage
```

#### Verifikasi Symlink
Cek apakah folder `public/storage` sudah ter-link:
```bash
# Windows
dir public\storage

# Linux/Mac
ls -la public/storage
```

### 7. Set Permissions (Linux/Mac Only)

```bash
# Set permission untuk storage dan bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set ownership (sesuaikan dengan user web server)
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

### 8. Clear & Optimize Cache

```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 9. Jalankan Aplikasi

#### Development Server
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

#### Production Server (Apache/Nginx)
Arahkan document root ke folder `public/`

---

## 👤 Login Default

Setelah seeder berhasil dijalankan:

```
Email: admin@admin.com
Password: password
```

**PENTING:** Segera ganti password default setelah login pertama!

---

## 🔧 Konfigurasi Web Server

### Apache (.htaccess)

File `.htaccess` sudah tersedia di folder `public/`. Pastikan module `mod_rewrite` aktif:

```bash
# Enable mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2
```

**VirtualHost Configuration:**
```apache
<VirtualHost *:80>
    ServerName e-case.local
    DocumentRoot /path/to/e-case/public

    <Directory /path/to/e-case/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/e-case-error.log
    CustomLog ${APACHE_LOG_DIR}/e-case-access.log combined
</VirtualHost>
```

### Nginx

**Nginx Configuration:**
```nginx
server {
    listen 80;
    server_name e-case.local;
    root /path/to/e-case/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 📁 Struktur Folder Penting

```
e-case/
├── app/                    # Kode aplikasi (Models, Controllers, dll)
├── bootstrap/              # Bootstrap files
├── config/                 # File konfigurasi
├── database/              
│   ├── migrations/        # Database migrations
│   └── seeders/           # Database seeders
├── public/                # Document root (PUBLIC FOLDER)
│   ├── index.php         # Entry point
│   ├── assets/           # CSS, JS, Images
│   └── storage/          # Symlink ke storage/app/public
├── resources/
│   └── views/            # Blade templates
├── routes/               # Route definitions
├── storage/              # File uploads, logs, cache
│   ├── app/
│   │   └── public/       # File public (photos, documents)
│   ├── framework/        # Framework generated files
│   └── logs/             # Application logs
└── vendor/               # Composer dependencies
```

---

## 🔍 Troubleshooting

### 1. Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### 2. Error: Permission Denied (storage/logs)
```bash
# Linux/Mac
chmod -R 775 storage
chown -R www-data:www-data storage

# Windows
# Klik kanan folder storage > Properties > Security > Edit > Beri Full Control
```

### 3. Error: "SQLSTATE[HY000] [1049] Unknown database"
- Pastikan database sudah dibuat
- Cek konfigurasi di file `.env`
```bash
php artisan config:clear
```

### 4. Symlink Tidak Berfungsi

**Windows:**
```bash
# Hapus symlink lama
rmdir public\storage

# Buat ulang dengan Command Prompt as Administrator
php artisan storage:link
```

**Linux/Mac:**
```bash
# Hapus symlink lama
rm public/storage

# Buat ulang
php artisan storage:link
```

### 5. CSS/JS Tidak Muncul
- Pastikan web server mengarah ke folder `public/`
- Bukan ke root folder `e-case/`

### 6. Error 500 - Internal Server Error
```bash
# Enable debug mode di .env
APP_DEBUG=true

# Clear cache
php artisan cache:clear
php artisan config:clear

# Cek log error
tail -f storage/logs/laravel.log
```

### 7. DataTables Tidak Muncul
- Pastikan koneksi internet aktif (DataTables menggunakan CDN)
- Atau download dan simpan lokal di `public/assets/`

---

## 📊 Database Seeder Info

Data yang akan di-generate oleh seeder:

| Seeder | Deskripsi |
|--------|-----------|
| **AdminSeeder** | User admin default |
| **ClassSeeder** | 12 kelas (X, XI, XII dengan jurusan) |
| **StudentSeeder** | 50 siswa sample |
| **ViolationSeeder** | 20 jenis pelanggaran dengan poin |
| **StudentViolationSeeder** | 100 record pelanggaran siswa |
| **RewardSeeder** | 5 jenis penghargaan |
| **AppDataSeeder** | Settings aplikasi |

---

## 🔐 Security Notes

### Production Deployment:

1. **Set APP_DEBUG=false di .env**
```env
APP_DEBUG=false
APP_ENV=production
```

2. **Ganti APP_KEY**
```bash
php artisan key:generate --force
```

3. **Setup HTTPS**
- Gunakan SSL Certificate (Let's Encrypt)
- Redirect HTTP ke HTTPS

4. **Database Security**
- Gunakan user database dengan privilege terbatas
- Jangan gunakan root user

5. **File Permissions**
```bash
# Jangan beri write access ke semua folder
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

6. **Backup Regular**
```bash
# Backup database
mysqldump -u root -p e_case > backup_$(date +%Y%m%d).sql

# Backup files
tar -czf e-case-backup_$(date +%Y%m%d).tar.gz /path/to/e-case
```

---

## 📞 Support

Jika mengalami kendala:

1. Cek file log: `storage/logs/laravel.log`
2. Pastikan semua requirements terpenuhi
3. Buka GitHub Issues: https://github.com/aldihidayat35/e-case/issues

---

## 📝 Changelog

### Version 1.0.0 (January 2026)
- ✅ Initial release
- ✅ Management siswa
- ✅ Management pelanggaran
- ✅ Management kelas
- ✅ Sistem poin pelanggaran
- ✅ Leaderboard siswa
- ✅ Dashboard analytics
- ✅ Sistem penghargaan

---

## 📄 License

Copyright © 2026 E-Case. All rights reserved.

---

**Selamat menggunakan E-Case! 🎉**
