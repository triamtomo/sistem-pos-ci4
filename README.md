# 🛒 Sistem Point of Sale (POS)

Aplikasi kasir (Point of Sale) berbasis web yang dibangun menggunakan CodeIgniter 4, dilengkapi autentikasi terenkripsi, kontrol akses berbasis peran, cetak struk otomatis, dan laporan penjualan real-time.

## ✨ Fitur Utama
- **Autentikasi Aman** — sistem login dengan enkripsi password (bcrypt)
- **Role-Based Access Control** — hak akses berbeda untuk tiap peran pengguna (misal admin & kasir)
- **Transaksi Penjualan** — pencatatan transaksi secara real-time
- **Cetak Struk Otomatis** — struk transaksi tercetak langsung setelah pembayaran
- **Laporan Penjualan** — rekap data penjualan untuk kebutuhan monitoring bisnis

## 🛠️ Tech Stack
- **Backend:** PHP, CodeIgniter 4
- **Database:** MySQL
- **Keamanan:** bcrypt password hashing

## 🚀 Cara Menjalankan Project

1. Clone repository ini
```bash
   git clone https://github.com/triamtomo/sistem-pos-ci4.git
```
2. Install dependencies
```bash
   composer install
```
3. Salin `.env.example` menjadi `.env`, lalu sesuaikan konfigurasi database
4. Import struktur database ke MySQL
5. Jalankan server lokal
```bash
   php spark serve
```

## 📁 Struktur Project
Mengikuti struktur standar CodeIgniter 4 (folder `app` untuk logic aplikasi, `public` sebagai entry point web).

## 👤 Author
**Triam Tomo**
Mahasiswa S1 Informatika — Universitas Bina Sarana Informatika
