# Projek Stok Barang

Aplikasi manajemen stok barang berbasis web sederhana, ditujukan untuk memudahkan pencatatan barang masuk dan keluar dalam suatu usaha seperti grosiran, toko, atau gudang kecil.

## 🧩 Fitur Utama

- Tambah barang baru (nama, deskripsi, stok awal)
- Update stok barang (barang masuk)
- (Opsional) Barang keluar, edit, dan hapus data
- Riwayat transaksi (masuk/keluar)
- Dashboard stok saat ini
- Sanitasi input untuk keamanan

## 🛠 Teknologi yang Digunakan

- PHP (native)
- MySQL
- HTML, CSS, JavaScript
- SB Admin Template (Bootstrap)
- Simple DataTables (untuk tampilan tabel interaktif)
- Font Awesome

## ⚙️ Cara Menjalankan

1. Clone repo ini atau unduh sebagai ZIP.
2. Simpan ke folder `htdocs/` (jika pakai XAMPP).
3. Buat database `db_barang1` di phpMyAdmin.
4. Import file SQL (jika tersedia) ke dalam database tersebut.
5. Jalankan via browser:



## 📁 Struktur Folder

- `index.php` – Halaman utama (dashboard)
- `function.php` – Logika bisnis (tambah barang, barang masuk, dsb)
- `css/styles.css` – Tampilan UI
- `js/` – Script tambahan
- `config/conn.php` – Koneksi database (jika terpisah)
- `database/` – File SQL (jika ada)

## 📜 Lisensi

Proyek ini bersifat open-source dan bebas dikembangkan lebih lanjut.
