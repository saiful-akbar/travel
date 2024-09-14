# Sistem Pemesanan Mobile Travel Online

# Persyaratan

- Laragon untuk web server
- PHP v8.2.x atau yang lebih terbaru
- Composer v2.4.x
- NodeJS v20.11.x
- Database MySQL atau MariaDB

# Instalasi

- Clone repository

  ```bash
  git clone https://github.com/saiful-akbar/travel.git && cd travel

  ```

- Install devDependencies

  ```bash
  sh app-dev.sh

  ```

- Sesuaikan pengaturan database pada file .env

  ```php
  DB_HOST=
  DB_PORT=
  DB_DATABASE=
  DB_USERNAME=
  DB_PASSWORD=

  ```

- Jalankan migrasi database

  ```bash
  php artisan migrate:fresh --seed
  ```

- Jalankan local server

  ```bash
  npm run dev

  ```

# Fitur

### Admin

- Autentikasi
  - Login admin
- Data Master
  - Mengelola data user
  - Mengelola data supir
  - Mengelola data kendaraan
  - Mengelola data perusahaan
  - Mengelola data media sosial
- Perjalanan
  - Mengelola data paket perjalanan
  - Mengelola data destinasi
  - Mengelola data harga
- Transaksi
  - Mengelola data pesanan
  - Mengelola data jadwal

# Catatan

1. Update status pesanan menjadi selesai jika tanggal saat ini sudah melebihi tanggal keberangkatan dan tanggal kepulangan pada halaman pesanan admin dan pesanan member.
