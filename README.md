# Sistem Pemesanan Mobile Travel Online

# Persyaratan

- Laragon untuk web server.
- PHP v8.2 atau yang lebih terbaru.
- Composer.
- Node JS & NPM
- Database MySQL.

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

rule pengecekan ketersediaan kendaraan

- ambil data unit_kendaraan berdasarkan id kendaraan yang dipilih.
- filter berdasarkan status dari unit_krndaraan yang tersedia.
- periksa apakah ada data tanggal_keberangkatan yang berada diantara periode keberangkatan member.
- periksa apakah ada data tanggal_kepulangan yang berada diantara periode keberangkatan member.
