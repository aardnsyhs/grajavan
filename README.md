## Menjalankan Proyek di Lokal

### 1. Clone Repository
Pertama, clone repository ini ke dalam direktori lokal Anda menggunakan git:

```bash
git clone https://github.com/aardnsyhs/grajavan.git
```

### 2. Masuk ke Direktori Proyek
Setelah cloning selesai, pindah ke direktori proyek tersebut:

```bash
cd grajavan
```

### 3. Install Dependencies
Laravel menggunakan Composer untuk dependency management. Jalankan perintah berikut untuk menginstall semua dependencies:

```bash
composer install
```
Jika belum menginstall Composer, Anda bisa mengikuti panduan instalasi [Di sini](https://getcomposer.org/).

### 4. Salin File .env

File `.env` berisi konfigurasi lingkungan aplikasi. Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

### 5. Generate Application Key

Laravel memerlukan application key yang unik. Generate application key dengan perintah berikut:

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database dengan pengaturan lokal Anda. Contohnya:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```
Pastikan Anda sudah membuat database yang sesuai dengan nama yang ada pada konfigurasi.

### 7. Migrasi Database

Jalankan perintah berikut untuk menjalankan migrasi dan membuat tabel-tabel yang diperlukan di database:

```bash
php artisan migrate
```

### 8. Jalankan Server Lokal

Setelah semua langkah di atas selesai, jalankan server lokal dengan perintah:

```bash
php artisan serve
```
Aplikasi Laravel sekarang berjalan di `http://127.0.0.1:8000` atau URL lain yang ditampilkan di terminal.

### 9. Install Dependencies Frontend

Proyek ini menggunakan frontend yang membutuhkan Node.js, jalankan perintah berikut untuk menginstall dependencies frontend dengan yarn:

```bash
yarn install
```
Setelah itu, Anda bisa menjalankan:
```bash
yarn dev
```
Untuk menjalankan development server dan meng-compile asset frontend.

### Selesai