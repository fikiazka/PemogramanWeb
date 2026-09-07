````markdown
## 1. Struktur Navigasi

Struktur navigasi sistem informasi perpustakaan adalah sebagai berikut:

```text
Login
  |
  v
Dashboard Petugas
  |
  +-- Peminjaman
  |
  +-- Pengembalian
  |
  +-- Riwayat
  |
  +-- Logout
````

---

## 2. Wireframe Login

```text
+----------------------------------+
|       SISTEM PERPUSTAKAAN        |
|                                  |
|              LOGIN               |
|                                  |
| Username                         |
| [____________________________]   |
|                                  |
| Password                         |
| [____________________________]   |
|                                  |
|          [     LOGIN     ]       |
|                                  |
+----------------------------------+
```

### Keterangan

Halaman login digunakan oleh petugas untuk masuk ke dalam sistem. Petugas mengisi username dan password, kemudian menekan tombol Login.

---

## 3. Wireframe Dashboard Petugas

```text
+------------------------------------------------+
| SISTEM PERPUSTAKAAN             Petugas Logout |
+------------------------------------------------+
|                                                |
| Dashboard                                      |
|                                                |
| +------------+ +------------+ +------------+   |
| | Total Buku | |  Anggota   | | Dipinjam   |   |
| |    120     | |     50     | |     15     |   |
| +------------+ +------------+ +------------+   |
|                                                |
| Menu:                                          |
| [ Peminjaman ] [ Pengembalian ] [ Riwayat ]    |
|                                                |
| Aktivitas Terbaru                              |
| +--------------------------------------------+ |
| | No | Anggota | Buku | Aktivitas | Tanggal |  |
| +--------------------------------------------+ |
| | 1  | ...     | ...  | ...       | ...     |  |
| | 2  | ...     | ...  | ...       | ...     |  |
| +--------------------------------------------+ |
+------------------------------------------------+
```
### Keterangan

Dashboard merupakan halaman utama petugas setelah berhasil login. Dashboard menampilkan informasi singkat seperti jumlah buku, jumlah anggota, jumlah buku yang sedang dipinjam, serta menu untuk mengakses fitur utama.

---

## 4. Wireframe Peminjaman

```text
+------------------------------------------------+
| SISTEM PERPUSTAKAAN             Petugas Logout |
+------------------------------------------------+
|                                                |
| Peminjaman                                     |
|                                                |
| Anggota                                        |
| [ Pilih Anggota             v ]                |
|                                                |
| Buku                                           |
| [ Pilih Buku                v ]                |
|                                                |
| Tanggal Peminjaman                             |
| [____________________________]                 |
|                                                |
| Tanggal Jatuh Tempo                            |
| [____________________________]                 |
|                                                |
|       [ Simpan Peminjaman ]                    |
|                                                |
| Data Peminjaman                                |
| +--------------------------------------------+ |
| | No | Anggota | Buku | Tanggal | Jatuh Tempo| |
| +--------------------------------------------+ |
+------------------------------------------------+
```

### Keterangan

Halaman peminjaman digunakan petugas untuk mencatat transaksi peminjaman buku. Petugas memilih anggota dan buku, kemudian mengisi tanggal peminjaman serta tanggal jatuh tempo.

---

## 5. Wireframe Pengembalian

```text
+------------------------------------------------+
| SISTEM PERPUSTAKAAN             Petugas Logout |
+------------------------------------------------+
|                                                |
| Pengembalian                                   |
|                                                |
| Cari Peminjaman                                |
| [________________________] [ Cari ]            |
|                                                |
| Detail Peminjaman                              |
| Nama Anggota    : ...........................  |
| Judul Buku      : ...........................  |
| Tanggal Pinjam  : ...........................  |
| Jatuh Tempo     : ...........................  |
|                                                |
| Tanggal Kembali                                |
| [____________________________]                 |
|                                                |
|      [ Proses Pengembalian ]                   |
+------------------------------------------------+
```

### Keterangan

Halaman pengembalian digunakan petugas untuk memproses buku yang dikembalikan. Petugas mencari data peminjaman, memeriksa detail transaksi, kemudian mengisi tanggal pengembalian dan memproses pengembalian.

---

## 6. Wireframe Riwayat

```text
+------------------------------------------------+
| SISTEM PERPUSTAKAAN             Petugas Logout |
+------------------------------------------------+
|                                                |
| Riwayat Transaksi                              |
|                                                |
| Filter                                         |
| [ Semua Aktivitas v ] [ Tanggal ] [ Cari ]     |
|                                                |
| +--------------------------------------------+ |
| | No | Anggota | Buku | Aktivitas | Tanggal |  |
| +--------------------------------------------+ |
| | 1  | ...     | ...  | Peminjaman| ...     |  |
| | 2  | ...     | ...  | Pengembalian| ...   |  |
| | 3  | ...     | ...  | Peminjaman| ...     |  |
| +--------------------------------------------+ |
+------------------------------------------------+
```

### Keterangan

Halaman riwayat digunakan petugas untuk melihat transaksi peminjaman dan pengembalian yang telah dilakukan. Petugas dapat menggunakan filter atau pencarian untuk menemukan transaksi tertentu.

---

## 7. User Flow Login

```text
Mulai
  |
  v
Halaman Login
  |
  v
Isi Username dan Password
  |
  v
Klik Login
  |
  v
Validasi Data
  |
  +---- Tidak Valid ----> Tampilkan Pesan Error
  |                              |
  |                              v
  |                         Kembali ke Login
  |
  +---- Valid ----------> Dashboard Petugas
```

---

## 8. User Flow Peminjaman

```text
Dashboard
  |
  v
Pilih Peminjaman
  |
  v
Pilih Anggota
  |
  v
Pilih Buku
  |
  v
Isi Tanggal Peminjaman
  |
  v
Isi Tanggal Jatuh Tempo
  |
  v
Klik Simpan
  |
  v
Data Peminjaman Tersimpan
  |
  v
Riwayat Diperbarui
```

---

## 9. User Flow Pengembalian

```text
Dashboard
  |
  v
Pilih Pengembalian
  |
  v
Cari Data Peminjaman
  |
  v
Tampilkan Detail Peminjaman
  |
  v
Isi Tanggal Pengembalian
  |
  v
Klik Proses Pengembalian
  |
  v
Status Peminjaman Diperbarui
  |
  v
Riwayat Diperbarui
```

---

## 10. User Flow Riwayat

```text
Dashboard
  |
  v
Pilih Riwayat
  |
  v
Pilih Filter
  |
  v
Klik Cari
  |
  v
Sistem Menampilkan Data Transaksi
  |
  v
Petugas Melihat Riwayat
```

---

## 11. User Flow Keseluruhan

```text
                    +---------+
                    |  LOGIN  |
                    +----+----+
                         |
                         v
                +------------------+
                |    DASHBOARD     |
                |     PETUGAS      |
                +--------+---------+
                         |
          +--------------+--------------+
          |              |              |
          v              v              v
   +-------------+ +-------------+ +-------------+
   | PEMINJAMAN  | |PENGEMBALIAN | |   RIWAYAT   |
   +-------------+ +-------------+ +-------------+
          |              |
          v              v
     Simpan Data    Update Status
          |              |
          +------+-------+
                 |
                 v
              RIWAYAT

6.4 Ide Latihan Tambahan (Opsional)

1. ## Wireframe Registrasi Anggota Baru

Aktor: Tamu

+------------------------------------------+
|        PERPUSTAKAAN - REGISTRASI         |
+------------------------------------------+
|                                          |
| Nama Lengkap                             |
| [____________________________]           |
|                                          |
| NIM / ID Anggota                         |
| [____________________________]           |
|                                          |
| Email                                    |
| [____________________________]           |
|                                          |
| Password                                 |
| [____________________________]           |
|                                          |
| Konfirmasi Password                      |
| [____________________________]           |
|                                          |
|              [ Daftar ]                  |
|                                          |
| Sudah punya akun? [ Login ]              |
+------------------------------------------
Keterangan:
Halaman ini digunakan oleh Tamu untuk melakukan registrasi sebagai anggota perpustakaan. Tamu mengisi data diri, email, dan password kemudian menekan tombol Daftar.

2. Tambahkan user flow baru
Contohnya skenario: Petugas mencari anggota yang tunggakannya sudah lewat jatuh tempo.

## User Flow - Mencari Anggota dengan Tunggakan

Petugas Login
     |
     v
Dashboard Petugas
     |
     v
Menu Anggota
     |
     v
Pilih "Cari Anggota"
     |
     v
Masukkan nama / ID anggota
     |
     v
Sistem mencari data anggota
     |
     +----------------------+
     |                      |
     v                      v
Anggota ditemukan       Tidak ditemukan
     |                      |
     v                      v
Tampilkan data          Tampilkan pesan
tunggakan               "Data tidak ditemukan"
     |
     v
Petugas melihat
detail tunggakan

3. ## Edge Case Tambahan

A. Peminjaman buku yang sama dua kali

Kalau Petugas mencoba meminjamkan buku yang sama ke anggota yang sama padahal peminjaman sebelumnya belum dikembalikan, sistem bisa mencatat dua transaksi aktif untuk satu buku fisik — padahal satu eksemplar cuma boleh dipegang satu anggota dalam satu waktu.

Penanganannya: sebelum tombol [Simpan] di form Peminjaman diproses, sistem perlu cek dulu apakah kombinasi anggota + buku itu sudah punya transaksi berstatus "Dipinjam" yang belum dikembalikan, dan menolak jika ya.

Aturan ini sifatnya sama dengan catatan (stok > 0) di user flow — dicatat sejak tahap wireframe supaya tidak lupa diimplementasikan saat coding nanti.