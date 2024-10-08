## Cara Menjalankan Proyek Laravel Secara Lokal

Langkah-langkah berikut ini menjelaskan bagaimana cara menjalankan proyek Laravel di lingkungan lokal Anda mulai dari clone project hingga menjalankannya.

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

Proyek ini menggunakan frontend yang membutuhkan Node.js, jalankan perintah berikut untuk menginstall dependencies frontend:

```bash
npm install
```
Setelah itu, Anda bisa menjalankan:
```bash
npm run dev
```
Untuk menjalankan development server dan meng-compile asset frontend.

### Selesai

Sekarang Anda sudah bisa mengakses aplikasi Laravel secara lokal melalui browser dengan URL yang ditampilkan (`http://127.0.0.1:8000`).

<hr>

### 10. Konfigurasi Filament Admin

Proyek ini menggunakan **Filament Admin** sebagai backend admin panel untuk manajemen aplikasi. Berikut adalah cara menggunakannya.

#### 10.1 Buat Akun Admin

Setelah Filament terinstall, Anda harus membuat akun admin untuk bisa mengakses dashboard admin. Gunakan perintah berikut untuk membuat admin user:

```bash
php artisan make:filament-user
```

Anda akan diminta memasukkan detail untuk akun admin seperti nama, email, dan password.

#### 10.2 Akses Dashboard Admin
Setelah user admin dibuat, Anda bisa mengakses dashboard admin Filament dengan mengunjungi:

```arduino
http://127.0.0.1:8000/admin
```
Masuk dengan akun admin yang telah Anda buat.

## Catatan Penting

Disarankan untuk membuka halaman admin di browser yang berbeda dari browser yang digunakan untuk sesi pengguna reguler. Hal ini untuk menghindari konflik autentikasi dan memastikan sesi admin berjalan dengan baik.

<hr>

Sekarang Anda sudah dapat menggunakan Filament sebagai panel admin untuk mengelola aplikasi Anda.