# SIMPUS-Mini
### Sistem Informasi Perpustakaan Sederhana

SIMPUS-Mini merupakan aplikasi web sederhana untuk membantu pengelolaan data perpustakaan. Aplikasi ini dikembangkan menggunakan PHP dan PostgreSQL dengan antarmuka berbasis web. Sistem menyediakan fitur pengelolaan data buku dan anggota, pencatatan peminjaman dan pengembalian, serta riwayat transaksi perpustakaan.

Aplikasi ini dibuat sebagai proyek praktikum Pemrograman Web untuk menerapkan pengembangan aplikasi web, pengelolaan basis data, autentikasi pengguna, dan konfigurasi lingkungan aplikasi.

## 1. Teknologi yang Digunakan

| Teknologi | Keterangan |
|---|---|
| PHP | Bahasa pemrograman sisi server |
| PostgreSQL | Sistem manajemen basis data |
| PDO | Penghubung aplikasi PHP dengan database |
| HTML dan CSS | Struktur dan tampilan halaman web |
| JavaScript | Mendukung interaksi pada antarmuka |
| PHP Built-in Server | Menjalankan aplikasi pada lingkungan lokal |

## 2. Fitur Aplikasi

### Autentikasi Pengguna
- Login dan logout pengguna.
- Pendaftaran akun jika fitur registrasi diaktifkan.
- Pembatasan akses berdasarkan peran pengguna yang diterapkan pada aplikasi.

### Pengelolaan Buku
- Menampilkan daftar buku.
- Menambahkan data buku.
- Mengubah data buku.
- Menghapus data buku.

### Pengelolaan Anggota
- Menampilkan daftar anggota perpustakaan.
- Menambahkan data anggota.
- Mengubah data anggota.
- Menghapus data anggota.

### Pengelolaan Peminjaman
- Mencatat transaksi peminjaman buku.
- Memproses pengembalian buku.
- Menampilkan riwayat peminjaman.
- Menampilkan informasi peminjaman pada dashboard.

### Fitur Pendukung
- Pencarian data.
- Pagination pada daftar data yang mendukungnya.
- Validasi input.
- Pesan notifikasi untuk memberikan informasi hasil operasi.
- Perlindungan CSRF pada formulir yang menerapkannya.

*Catatan: Ketersediaan fitur dapat bergantung pada implementasi dan hak akses pengguna di aplikasi.*

## 3. Struktur Folder

```text
Pertemuan 4/
├── auth/
│   ├── auth.php
│   ├── login.php
│   ├── proses_login.php
│   ├── register.php
│   ├── proses_register.php
│   └── logout.php
├── includes/
│   ├── koneksi.php
│   ├── header.php
│   ├── footer.php
│   ├── helpers.php
│   └── csrf.php
├── buku/
├── anggota/
├── peminjaman/
│   ├── tambah.php
│   ├── proses_tambah.php
│   ├── kembali.php
│   ├── proses_kembali.php
│   └── riwayat.php
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
├── index.php
└── README.md
```

Folder `auth` berisi proses autentikasi pengguna. Folder `includes` menyimpan komponen yang digunakan bersama, termasuk konfigurasi koneksi database. Folder `buku`, `anggota`, dan `peminjaman` berisi halaman untuk mengelola data dan transaksi. Folder `assets` menyimpan file pendukung tampilan dan interaksi antarmuka.

## 4. Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan perangkat telah memiliki:

- PHP dengan ekstensi `pdo_pgsql` yang aktif.
- PostgreSQL.
- Browser untuk mengakses aplikasi.
- Terminal atau PowerShell untuk menjalankan server PHP.

Versi PHP dan PostgreSQL yang digunakan sebaiknya disesuaikan dengan lingkungan pengembangan aplikasi.

## 5. Konfigurasi Database

Aplikasi menggunakan PostgreSQL dan menghubungkan database melalui PDO. Pengaturan koneksi dilakukan menggunakan environment variable agar informasi koneksi tidak perlu ditulis langsung pada halaman aplikasi.

Variabel konfigurasi yang diperlukan:

| Variabel | Fungsi |
|---|---|
| `DB_HOST` | Alamat server database |
| `DB_PORT` | Port PostgreSQL |
| `DB_NAME` | Nama database |
| `DB_USER` | Username database |
| `DB_PASSWORD` | Password database |

Contoh konfigurasi lokal:

```text
DB_HOST=localhost
DB_PORT=5434
DB_NAME=simpus_mini_deploy
DB_USER=postgres
DB_PASSWORD=<password PostgreSQL>
```

Ganti nilai konfigurasi sesuai lingkungan masing-masing. Password database tidak boleh dimasukkan ke repository publik atau dibagikan dalam dokumentasi.

## 6. Instalasi dan Menjalankan Aplikasi

### A. Menyiapkan Database

1. Jalankan layanan PostgreSQL.
2. Buat database dengan nama yang sesuai, misalnya `simpus_mini_deploy`.
3. Impor struktur database dari file SQL hasil ekspor.
4. Siapkan data awal yang diperlukan oleh aplikasi.
5. Pastikan tabel dan relasi database telah tersedia.

### B. Mengatur Koneksi

1. Buka terminal pada direktori utama project.
2. Atur environment variable database sesuai konfigurasi lokal.
3. Pastikan `includes/koneksi.php` membaca variabel tersebut.
4. Pastikan username dan password database valid.

### C. Menjalankan Server Lokal

Jalankan perintah berikut melalui PowerShell dari direktori utama project:

```powershell
$env:DB_HOST = "localhost"
$env:DB_PORT = "5434"
$env:DB_NAME = "simpus_mini_deploy"
$env:DB_USER = "postgres"
$env:DB_PASSWORD = Read-Host "Password PostgreSQL"

php -S localhost:8000
```

Sesuaikan port dan nama database apabila berbeda. Masukkan password PostgreSQL ketika diminta.

Setelah server berjalan, buka browser dan akses:

```text
http://localhost:8000/
```

Untuk menghentikan server, tekan `Ctrl + C` pada terminal yang menjalankannya.

## 7. Pengujian Aplikasi

Pengujian dilakukan untuk memastikan fungsi utama aplikasi dapat berjalan sesuai kebutuhan.

| No. | Skenario Pengujian | Hasil yang Diharapkan |
|---|---|---|
| 1 | Login menggunakan akun yang valid | Pengguna berhasil masuk |
| 2 | Membuka dashboard | Informasi dashboard ditampilkan |
| 3 | Menambahkan data buku | Data tersimpan dan tampil pada daftar |
| 4 | Mengubah data buku | Perubahan data tersimpan |
| 5 | Menghapus data buku | Data terhapus sesuai ketentuan sistem |
| 6 | Menambahkan data anggota | Data anggota tersimpan |
| 7 | Mengubah dan menghapus data anggota | Perubahan berjalan sesuai fungsi |
| 8 | Mencatat peminjaman | Transaksi tercatat pada database |
| 9 | Memproses pengembalian | Status pengembalian diperbarui |
| 10 | Membuka riwayat peminjaman | Riwayat transaksi ditampilkan |

Hasil aktual setiap skenario perlu diperiksa langsung pada aplikasi. Screenshot hasil pengujian dapat ditambahkan sebagai bukti dokumentasi.

## 8. Keamanan dan Konfigurasi

Beberapa hal yang perlu diperhatikan dalam penggunaan aplikasi:

- Gunakan environment variable untuk menyimpan konfigurasi koneksi database.
- Jangan mengunggah password atau kredensial asli ke repository.
- Gunakan validasi input pada formulir.
- Terapkan pemeriksaan autentikasi dan hak akses pada halaman yang memerlukan login.
- Gunakan konfigurasi server yang sesuai apabila aplikasi akan dipublikasikan ke internet.

PHP Built-in Server ditujukan untuk pengembangan dan pengujian lokal, bukan sebagai server produksi publik.

## 9. Status Deployment

Saat ini, SIMPUS-Mini dijalankan pada lingkungan lokal menggunakan PHP Built-in Server dan PostgreSQL. Aplikasi diakses melalui `http://localhost:8000/` selama server lokal berjalan.

Deployment ke hosting publik belum dilakukan. Oleh karena itu, aplikasi belum dapat diakses secara langsung oleh pengguna melalui internet.

## 10. Pengembang dan Pengembangan Selanjutnya

SIMPUS-Mini dikembangkan sebagai proyek praktikum Pemrograman Web. Pengembangan selanjutnya dapat mencakup penyempurnaan dokumentasi pengguna, pengujian sistem secara menyeluruh, peningkatan keamanan, dan deployment ke hosting publik yang mendukung PHP serta PostgreSQL.

---

**SIMPUS-Mini — Sistem Informasi Perpustakaan Sederhana**  
*Proyek Praktikum Pemrograman Web*