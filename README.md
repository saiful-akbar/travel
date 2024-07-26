# Sistem Pemesanan Mobile Travel Online

# 1. Persyaratan

- Laragon untuk web server.
- PHP v8.2 atau yang lebih terbaru.
- Composer.
- Database MySQL.

# 2. Fitur-Fitur Aplikasi

## 2.1 Fitur Member

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

## 2.2 Fitur Admin

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

# 3. Catatan

- Penyewaan mobil hanya tersedia dalam 2 macam:

  1. Antar jemput
  2. Paket travel

- Tipe mobil hanya ada 2:
  1. Tipe hiace commuter
  2. Tipe hiace premio

# 2. Rule

- Pesanan
  - Customer harus memilih terlebih dahulu paket destinasi dan waktu peminjaman untuk menentukan ketersediaan mobil.
- Pembatalan pesanan
  - Pembatalan pesanan hanya bisa dilakukan oleh customer dalam waktu 1x24 jam setelah pemesanan.
- Delete data
  - Untuk penghapusan supir, kendaraan, unit kendaraan, paket dan destinasi hanya bisa jika tidak memiliki pesanan atau jika status pesanan `selesai` atau `dibatalkan`.
