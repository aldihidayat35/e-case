# 🎓 E-CASE SYSTEM - Sistem Poin Pelanggaran & Penghargaan Siswa

## 📋 PROGRESS DEVELOPMENT

### ✅ **BACKEND - COMPLETE (100%)**

#### 1. Database Structure ✓
- ✅ Migration classes table
- ✅ Migration students table (with NIS, total_points)
- ✅ Migration violations table (jenis pelanggaran & poin)
- ✅ Migration student_violations table (riwayat pelanggaran)
- ✅ Migration rewards table
- ✅ Migration users table (role admin)

#### 2. Eloquent Models ✓
- ✅ ClassRoom model (relasi ke students)
- ✅ Student model (relasi ke class, violations, rewards + helper methods)
- ✅ Violation model
- ✅ StudentViolation model (AUTO-UPDATE total_points via observer)
- ✅ Reward model
- ✅ User model (isAdmin() helper)

#### 3. Seeders ✓
- ✅ AdminSeeder (2 admin default)
- ✅ ClassSeeder (15 kelas: X TO1-TO3, TKI, TPM | XI & XII TPM, TKJ, TKR, TBSM, TAB)
- ✅ ViolationSeeder (12 jenis pelanggaran dengan poin)

#### 4. Routes ✓
- ✅ Public routes (home, leaderboard, student search)
- ✅ Auth routes (login, logout)
- ✅ Admin routes (protected with auth + admin middleware)

#### 5. Controllers ✓
**Admin Controllers:**
- ✅ DashboardController (statistik & overview)
- ✅ ClassController (CRUD kelas)
- ✅ StudentController (CRUD siswa + search & filter)
- ✅ ViolationController (CRUD jenis pelanggaran)
- ✅ StudentViolationController (pencatatan, history, denda & reset)
- ✅ RewardController (sistem reward)

**Public Controllers:**
- ✅ HomeController (landing page + leaderboard)
- ✅ LeaderboardController (ranking kedisiplinan)
- ✅ StudentSearchController (search by NIS)
- ✅ LoginController (authentication)

#### 6. Middleware & Security ✓
- ✅ AdminMiddleware (role-based access control)
- ✅ Registered di bootstrap/app.php

---

### ✅ **FRONTEND - PARTIAL (40%)**

#### Views Completed:
- ✅ layouts/app.blade.php (Main admin layout dengan Metronic 8)
- ✅ layouts/auth.blade.php (Auth layout)
- ✅ layouts/public.blade.php (Public layout dengan navbar)
- ✅ auth/login.blade.php (Login admin page)
- ✅ home.blade.php (Public landing page)
- ✅ student-search.blade.php (Search form untuk orang tua)
- ✅ student-detail.blade.php (Detail siswa + riwayat)
- ✅ admin/dashboard.blade.php (Admin dashboard dengan statistik)
- ✅ admin/classes/index.blade.php (List kelas)

#### Views Belum Dibuat:
- ⏳ admin/classes/create.blade.php
- ⏳ admin/classes/edit.blade.php
- ⏳ admin/students/* (index, create, edit, show)
- ⏳ admin/violations/* (index, create, edit)
- ⏳ admin/student-violations/* (index, create, history, fines)
- ⏳ admin/rewards/* (index, create, eligible)
- ⏳ leaderboard.blade.php (public leaderboard)
- ⏳ layout partials (sidebar, header, footer untuk admin)

---

## 🚀 CARA SETUP & MENJALANKAN

### 1. **Setup Database**

```bash
# 1. Buat database MySQL
# Nama database: e_case (sesuaikan di .env)

# 2. Update file .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_case
DB_USERNAME=root
DB_PASSWORD=

# 3. Jalankan migrations
php artisan migrate

# 4. Seed data awal (admin, kelas, violations)
php artisan db:seed

# 5. (Optional) Generate app key jika belum
php artisan key:generate
```

### 2. **Jalankan Server**

```bash
# Development server
php artisan serve

# Akses:
# - Public: http://localhost:8000
# - Admin: http://localhost:8000/login
```

### 3. **Login Admin**

**Default Admin Credentials:**
- Email: `admin@ecase.com`
- Password: `password`

**Alternative Admin:**
- Email: `admin@sekolah.com`
- Password: `admin123`

---

## 📂 STRUKTUR FILE PENTING

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── ClassController.php
│   │   │   ├── StudentController.php
│   │   │   ├── ViolationController.php
│   │   │   ├── StudentViolationController.php
│   │   │   └── RewardController.php
│   │   ├── Auth/
│   │   │   └── LoginController.php
│   │   ├── HomeController.php
│   │   ├── LeaderboardController.php
│   │   └── StudentSearchController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── ClassRoom.php
│   ├── Student.php
│   ├── Violation.php
│   ├── StudentViolation.php (AUTO-UPDATE POIN)
│   ├── Reward.php
│   └── User.php

database/
├── migrations/
│   ├── 2026_01_15_062358_create_classes_table.php
│   ├── 2026_01_15_062402_create_students_table.php
│   ├── 2026_01_15_062402_create_violations_table.php
│   ├── 2026_01_15_062403_create_student_violations_table.php
│   ├── 2026_01_15_062403_create_rewards_table.php
│   └── 2026_01_15_062404_add_role_to_users_table.php
└── seeders/
    ├── AdminSeeder.php
    ├── ClassSeeder.php
    ├── ViolationSeeder.php
    └── DatabaseSeeder.php

resources/views/
├── layouts/
│   ├── app.blade.php (Admin Layout)
│   ├── auth.blade.php (Auth Layout)
│   └── public.blade.php (Public Layout)
├── admin/
│   ├── dashboard.blade.php
│   └── classes/
│       └── index.blade.php
├── auth/
│   └── login.blade.php
├── home.blade.php
├── student-search.blade.php
└── student-detail.blade.php

routes/
└── web.php (Complete routing)
```

---

## 🎯 FITUR YANG SUDAH BERFUNGSI

### Public Features:
1. ✅ **Home Page** - Landing page dengan top 10 siswa terdisiplin
2. ✅ **Student Search** - Orang tua bisa cari data siswa by NIS
3. ✅ **Student Detail** - Lihat riwayat pelanggaran & reward siswa
4. ⏳ **Leaderboard** - Ranking kedisiplinan (backend ready, view belum)

### Admin Features:
1. ✅ **Login System** - Authentication dengan role check
2. ✅ **Dashboard** - Statistik real-time
3. ✅ **Data Kelas** - List kelas sudah bisa ditampilkan
4. ⏳ **CRUD Kelas** - Create/Edit/Delete (controller ready, form views belum)
5. ⏳ **CRUD Siswa** - (controller ready, views belum)
6. ⏳ **CRUD Pelanggaran** - (controller ready, views belum)
7. ⏳ **Pencatatan Pelanggaran** - (controller ready, views belum)
8. ⏳ **Denda & Reset Poin** - (controller ready, views belum)
9. ⏳ **Sistem Reward** - (controller ready, views belum)

---

## 🔥 FITUR UNGGULAN

### 1. **Auto-Update Poin** ⚡
StudentViolation model menggunakan Eloquent Observer untuk otomatis update `total_points` siswa:
- Saat pelanggaran dicatat → poin otomatis bertambah
- Saat pelanggaran dihapus → poin otomatis berkurang

### 2. **Role-Based Access Control** 🔒
- Public: bisa melihat data transparansi
- Admin: full CRUD dengan middleware protection

### 3. **Database Transaction** 💾
- Pencatatan pelanggaran menggunakan DB transaction
- Rollback otomatis jika error

### 4. **Search & Filter** 🔍
- Student: search by name/NIS, filter by class
- Violations: filter by class, date, student

---

## ⚠️ CATATAN PENTING

1. **Poin Siswa** - Tidak bisa diinput manual, hanya update otomatis via sistem
2. **Delete Kelas** - Tidak bisa jika masih ada siswa
3. **Delete Violation Type** - Tidak bisa jika sudah digunakan
4. **Reset Poin** - Riwayat pelanggaran tetap tersimpan
5. **Reward** - Hanya untuk siswa dengan 0 poin

---

## 📝 NEXT STEPS (TO-DO)

### Priority High:
1. Buat partials untuk admin layout (sidebar, header, footer)
2. Buat form views untuk CRUD (create.blade.php, edit.blade.php)
3. Buat views untuk student violations management
4. Buat views untuk rewards system
5. Buat public leaderboard view

### Priority Medium:
6. Export data (Excel/PDF)
7. Chart visualization (optional)
8. Advanced filtering
9. Email notification (optional)

### Priority Low:
10. User profile management
11. Activity logs
12. Print reports

---

## 🎨 DESIGN SYSTEM

**Template:** Metronic 8 (Bootstrap 5)
- Color Scheme: Professional
- Components: Cards, Tables, Forms, Modals
- Icons: Keenthemes Icons (ki-duotone)
- Responsive: Mobile-friendly

---

## 📞 SUPPORT

Jika ada error atau pertanyaan:
1. Check console/log error
2. Verify database connection
3. Check migration status: `php artisan migrate:status`
4. Clear cache: `php artisan cache:clear`
5. Clear config: `php artisan config:clear`

---

**Status:** Backend Complete | Frontend 40% Done
**Last Update:** {{ date('Y-m-d') }}
**Version:** 1.0.0-beta
