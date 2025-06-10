# Setup Database untuk Aplikasi Toko Buku Online

## Langkah-langkah Setup Database:

### 1. Jalankan XAMPP/Laragon
Pastikan Apache dan MySQL sudah berjalan di XAMPP atau Laragon.

### 2. Import Database
1. Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
2. Klik tab "SQL"
3. Copy dan paste isi file `database.sql` 
4. Klik "Go" untuk menjalankan script

### 3. Verifikasi Database
Setelah import berhasil, Anda akan melihat:
- Database: `pemrograman_web_contoh`
- Tabel: `Buku`, `Pelanggan`, `Pesanan`, `Detail_Pesanan`
- Data sample sudah terisi otomatis

### 4. Konfigurasi Koneksi (Optional)
Jika diperlukan, edit file `koneksi_db.php` untuk menyesuaikan:
- Host: localhost (default)
- Username: root (default)
- Password: (kosong/default)
- Database: pemrograman_web_contoh

### 5. Akses Aplikasi
Buka browser dan akses: `http://localhost/pemrograman-berbasis-web/Pertemuan13/`

## Fitur Aplikasi:
- ✅ CRUD Buku (Create, Read, Update, Delete)
- ✅ Pencarian berdasarkan judul dan tahun terbit
- ✅ Sistem transaksi pemesanan
- ✅ Detail pesanan dengan invoice
- ✅ Manajemen stok otomatis
- ✅ UI Modern dengan Bootstrap dan animasi CSS

## Struktur Database:

### Tabel Buku
- ID (Primary Key)
- Judul
- Penulis
- Tahun_Terbit
- Harga
- stok

### Tabel Pelanggan
- ID (Primary Key)
- Nama
- Email
- Alamat
- Telepon

### Tabel Pesanan
- ID (Primary Key)
- Tanggal_Pesanan
- Pelanggan_ID (Foreign Key)
- Total_Harga

### Tabel Detail_Pesanan
- ID (Primary Key)
- Pesanan_ID (Foreign Key)
- Buku_ID (Foreign Key)
- Kuantitas
- Harga_Per_Satuan

Selamat mencoba! 🚀
