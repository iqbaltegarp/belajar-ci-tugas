# 🛍️ Toko Online - CodeIgniter 4

Proyek ini adalah platform toko online berbasis web menggunakan **CodeIgniter 4**. Sistem ini memungkinkan pembeli (guest) melakukan pembelian produk dan admin untuk mengelola produk, kategori, diskon harian, dan melihat transaksi.

---

## 📚 Daftar Isi

- [✨ Fitur](#-fitur)
- [⚙️ Persyaratan Sistem](#️-persyaratan-sistem)
- [🚀 Instalasi](#-instalasi)
- [📁 Struktur Proyek](#-struktur-proyek)
- [👤 Akun Demo](#-akun-demo)

---

## ✨ Fitur

### 🔐 Autentikasi

- Login berdasarkan **role**: `admin` dan `guest`
- Validasi username dan password
- Redirect berdasarkan peran

### 📦 Produk & Kategori

- Admin dapat mengelola produk: tambah, edit, hapus, upload foto
- Manajemen kategori produk

### 🛒 Keranjang Belanja

- Guest dapat:
  - Menambahkan produk ke keranjang
  - Menghapus atau mengedit jumlah
  - Melihat subtotal dan total harga

### 🎁 Diskon Harian (Admin Only)

- Diskon harian disimpan di database
- Saat **guest login**, diskon hari ini disimpan ke `session`
- Saat checkout, diskon diterapkan per produk

### 💳 Checkout & Transaksi

- Form checkout: alamat, ongkir
- Integrasi API RajaOngkir Komerce untuk lokasi dan biaya kirim
- Data transaksi disimpan di tabel `transaction` dan `transaction_detail`

### 📊 Web Service (API)

- Endpoint API dengan autentikasi `API Key`
- Mengembalikan data transaksi dan detail item
- Bisa diakses melalui CURL atau frontend

### 🧾 Laporan Admin

- Admin dapat melihat semua transaksi
- Menampilkan total, status, tanggal, dll

### 🖥️ Halaman Tambahan

- FAQ
- Contact
- Profile

---

## ⚙️ Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL / MariaDB
- XAMPP/Laragon
- Web Browser

---

## Instalasi

1. **Clone repository ini**
   ```bash
   git clone [URL repository]
   cd belajar-ci-tugas
   ```
2. **Install dependensi**
   ```bash
   composer install
   ```
3. **Konfigurasi database**

   database.default.hostname = localhost
   database.default.database = tugas4pwl
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi

API_KEY = random123678abcghi
COST_KEY = your_rajaongkir_api_key

4. **Jalankan migrasi database**
   ```bash
   php spark migrate
   ```
5. **Seeder data**
   ```bash
   php spark db:seed ProductSeeder
   ```
   ```bash
   php spark db:seed UserSeeder
   ```
6. **Jalankan server**
   ```bash
   php spark serve
   ```
7. **Akses aplikasi**
   Buka browser dan akses `http://localhost:8080` untuk melihat aplikasi.

## Struktur Proyek

belajar-ci/
├── app/
│ ├── Config/
│ ├── Controllers/
│ │ ├── AuthController.php
│ │ ├── Home.php
│ │ ├── TransaksiController.php
│ │ ├── DiskonController.php
│ │ └── ApiController.php
│ ├── Filters/
│ ├── Models/
│ │ ├── ProductModel.php
│ │ ├── UserModel.php
│ │ ├── DiskonModel.php
│ │ ├── TransactionModel.php
│ │ └── TransactionDetailModel.php
│ ├── Views/
│ │ ├── layout.php
│ │ ├── v_login.php
│ │ ├── v_keranjang.php
│ │ ├── v_checkout.php
│ │ └── diskon/
│ │ ├── index.php
│ │ ├── create.php
│ │ └── edit.php
├── public/
│ └── img/ (gambar produk)
│ └── NiceAdmin/ (template UI)
├── writable/
├── .env
├── composer.json
└── spark

👥 Akun Demo
| Role | Username | Password |
| ----- | --------- | --------- |
| Admin | `kusada` | `1234567` |
| Guest | `gandi83` | `1234567` |
