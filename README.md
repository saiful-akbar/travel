# Sistem Pemesanan Mobile Travel Online

# Persyaratan

- Laragon untuk web server.
- PHP v8.2 atau yang lebih terbaru.
- Composer.
- Node JS & NPM
- Database MySQL.

# Fitur-Fitur Aplikasi

## Fitur Member

- Melihat Profil Perusahaan
- Melihat Layanan yang Diberikan Perusahaan
- Melihat Daftar Kendaraan
- Melihat Syarat dan Ketentuan
- Register Member
- Login Member
- Melakukan Pesanan
- Melihat Daftar Pesanan
- Melihat Tagihan dari Pesanan
- Melihat dan Mencetak Invoice
- Melihat Daftar Destinasi
- Melihat Daftar Paket
- Logout Member

## Fitur Admin

- Login Dashboard
- Mengelola Data User
- Mengelola Data Kendaraan
- Mengelola Data Destinasi
- Mengelola Data Paket Destinasi
- Mengelola Data Pesanan Member
- Mengelola Data Jadwal
- Laporan
- Mengelola Data Profil Perusahaan
- Mengelola Data Content
- Logout Admin

## Daftar Menu / Halaman Aplikasi

### Halaman Umum (Akses oleh Semua Pengguna)

1. Beranda

- Deskripsi layanan
- Informasi perusahaan
- Testimoni pelanggan

2. Tentang Kami

- Profil perusahaan
- Visi dan misi
- Tim manajemen

3. Kontak

- Formulir kontak
- Alamat perusahaan
- Nomor telepon dan email

4. Layanan Kami

- Deskripsi layanan yang ditawarkan
- Paket destinasi yang tersedia
- Galeri foto kendaraan dan destinasi

5. Blog/Artikel

- Artikel terkait travel
- Tips dan panduan perjalanan

### Halaman Member (Akses setelah Login)

1. Dashboard Member

- Ringkasan aktivitas terbaru
- Informasi akun

2. Profil Saya

- Edit profil
- Ubah kata sandi

3. Pemesanan Kendaraan

- Formulir pemesanan
- Pilih mobil dan tanggal perjalanan
- Konfirmasi dan pembayaran

4. Paket Destinasi

- Lihat daftar paket destinasi
- Detail setiap paket
- Pemesanan paket

5. Riwayat Pemesanan

- Lihat riwayat pemesanan
- Status pemesanan

### Halaman Admin (Akses setelah Login)

1. Dashboard Admin

- Statistik pemesanan
- Ringkasan laporan

2. Manajemen Pengguna

- Tambah, edit, dan hapus member
- Lihat daftar pengguna

3. Manajemen Kendaraan

- Tambah, edit, dan hapus kendaraan
- Lihat daftar kendaraan

4. Manajemen Paket Destinasi

- Tambah, edit, dan hapus paket destinasi
- Lihat daftar paket

5. Manajemen Pemesanan

- Lihat dan kelola semua pemesanan
- Status dan laporan pemesanan

### Halaman Autentikasi

1. Login
2. Registrasi
3. Lupa Kata Sandi

# Instalasi

## Instalasi Pengembangan

```bash
git clone https://github.com/saiful-akbar/travel.git && cd travel

```

```bash
sh app-dev.sh

```

```bash
php artisan migrate:fresh --seed && npm run dev

```

## Instalasi Produksi

```bash
sh app-build.sh

```

# Catatan

- Penyewaan mobil hanya tersedia dalam 2 macam:
  - Antar jemput
  - Paket travel
- Tipe mobil hanya ada 2:
  - Tipe hiace commuter
  - Tipe hiace premio
- Pesanan
  - Customer harus memilih terlebih dahulu paket destinasi dan waktu peminjaman untuk menentukan ketersediaan mobil.
- Pembatalan pesanan
  - Pembatalan pesanan hanya bisa dilakukan oleh customer dalam waktu 1x24 jam setelah pemesanan.
- Buat crud untuk data media sosial.
- Buat tabel database untuk testimoni
