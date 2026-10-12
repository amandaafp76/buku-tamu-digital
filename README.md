📖 Buku Tamu Digital

Aplikasi Buku Tamu Digital merupakan aplikasi berbasis web dan Progressive Web App (PWA) yang dirancang untuk mempermudah proses pencatatan dan pengelolaan kunjungan tamu secara digital. Aplikasi ini dikembangkan sebagai alternatif pencatatan tamu secara manual yang dapat digunakan di sekolah, kantor desa, instansi pemerintah, perusahaan, gedung, hotel, serta berbagai tempat pelayanan publik lainnya.

Project ini dikembangkan untuk memenuhi kebutuhan tugas magang dengan berfokus pada desain antarmuka modern bergaya iOS 26 Look / Liquid Glass, keamanan sistem, kemudahan penggunaan, serta pengalaman pengguna yang nyaman di berbagai perangkat.

✨ Fitur Utama

🖥️ 1. Administrator

Administrator memiliki akses untuk mengelola seluruh data dan konfigurasi sistem melalui fitur-fitur berikut:

Dashboard: Menampilkan statistik kunjungan harian, mingguan, dan bulanan, dilengkapi dengan grafik untuk memudahkan pemantauan aktivitas.

Data Master: Mengelola data pegawai, bagian atau departemen, tujuan kunjungan, serta akun pengguna.

Data Kunjungan: Melihat, mencari, memfilter, mengedit, dan menghapus data kunjungan.

Laporan: Menyediakan laporan kunjungan berdasarkan periode harian, mingguan, bulanan, maupun rentang tanggal tertentu, dengan dukungan ekspor ke format PDF dan Excel.

Activity Log: Mencatat riwayat aktivitas pengguna untuk membantu proses pemantauan dan audit sistem.

Pengaturan: Mengelola konfigurasi sistem, warna utama aplikasi, identitas institusi, template pesan, serta integrasi WAKITA.

👤 2. Petugas

Petugas bertanggung jawab membantu proses pemantauan kunjungan dan pencatatan kepulangan tamu melalui fitur berikut:

Dashboard: Memantau aktivitas dan data kunjungan secara langsung.

Data Kunjungan: Melihat daftar serta detail kunjungan tamu.

Scan QR Code: Memindai QR Code untuk memproses check-out atau kepulangan tamu.

Riwayat Kunjungan: Melihat daftar kunjungan yang telah selesai.

🎫 3. Tamu (Kiosk)

Halaman kiosk memungkinkan tamu melakukan registrasi secara mandiri tanpa perlu membuat akun atau login.

Registrasi Bertahap: Proses registrasi dilakukan melalui beberapa tahap, mulai dari pengisian identitas, pemilihan tujuan kunjungan, pengambilan foto, hingga tanda tangan digital.

Kamera Langsung: Mengambil foto menggunakan kamera perangkat dengan alternatif unggah foto apabila diperlukan.

Tanda Tangan Digital: Mendukung tanda tangan melalui canvas menggunakan mouse maupun layar sentuh.

QR Code: Menghasilkan QR Code yang dapat digunakan untuk memproses check-out melalui petugas.

Tanpa Login: Tamu dapat melakukan registrasi secara mandiri melalui halaman kiosk.

📱 4. Progressive Web App (PWA)

Aplikasi dilengkapi dengan dukungan PWA untuk memberikan pengalaman penggunaan yang lebih fleksibel.

Dapat diinstal ke layar utama perangkat yang kompatibel.

Menampilkan indikator status koneksi ketika perangkat offline.

Memiliki tampilan responsif untuk ponsel, tablet, dan desktop.

Mendukung safe area pada perangkat modern.

Memanfaatkan Web App Manifest dan Service Worker untuk mendukung kemampuan PWA.

Catatan: Indikator offline tidak berarti seluruh fitur dapat digunakan tanpa koneksi internet. Kemampuan penggunaan saat offline bergantung pada implementasi caching dan kebutuhan data masing-masing fitur.

🎨 Desain Antarmuka

Aplikasi ini mengadopsi gaya desain iOS 26 Look dengan pendekatan Liquid Glass atau Frosted Glass, yang mengutamakan tampilan modern, bersih, dan nyaman digunakan.

Prinsip desain yang diterapkan meliputi:

Glass Surface: Kartu dan komponen antarmuka menggunakan efek transparansi, backdrop-filter: blur, garis tepi tipis, highlight, dan bayangan lembut.

Consistent Border Radius: Menggunakan sudut membulat dengan radius sekitar 20–28 piksel untuk menjaga konsistensi visual.

Pill Buttons: Tombol dengan sudut membulat penuh untuk memberikan kesan modern.

Dynamic Theme Color: Warna utama antarmuka dapat disesuaikan melalui pengaturan administrator.

Ambient Gradient: Latar belakang menggunakan gradasi warna lembut untuk menciptakan tampilan yang lebih menarik.

Mobile-First Design: Antarmuka dirancang agar tetap nyaman digunakan pada ponsel, tablet, maupun desktop.

🛠️ Teknologi yang Digunakan

Kategori

Teknologi

Backend

PHP 8, CodeIgniter 4

Database

MySQL / MariaDB

Frontend

Bootstrap 5, HTML5, CSS3, JavaScript

Font

Poppins

Grafik

Chart.js

QR Code

Endroid QR Code

PDF

Dompdf

Excel

PhpSpreadsheet

PWA

Web App Manifest, Service Worker

Version Control

Git

🚀 Instalasi dan Konfigurasi

1. Persyaratan Sistem

Pastikan perangkat telah memiliki perangkat lunak berikut:

PHP 8.1 atau versi yang lebih baru.

Composer.

MySQL atau MariaDB.

Git.

Web server seperti Apache atau Nginx, atau server pengembangan bawaan CodeIgniter 4.

Pastikan juga ekstensi PHP yang dibutuhkan oleh CodeIgniter 4 dan seluruh dependensi project telah diaktifkan.

2. Clone Repository

Buka terminal atau command prompt, kemudian jalankan perintah.

Ganti username dan nama repository sesuai dengan alamat repository yang sebenarnya.

3. Instal Dependensi

Jalankan Composer untuk menginstal seluruh dependensi project:

composer install

4. Membuat File Environment

Salin file konfigurasi bawaan menjadi .env.

Pada Linux atau macOS:

cp env .env

Pada Windows PowerShell:

Copy-Item env .env

Jika repository menyediakan .env.example sebagai template konfigurasi, sesuaikan sumber file dengan file template yang tersedia.

5. Konfigurasi Database

Buka file .env, kemudian sesuaikan konfigurasi aplikasi dan database dengan lingkungan pengembangan yang digunakan.

Sesuaikan hostname, nama database, username, dan password berdasarkan konfigurasi MySQL atau MariaDB pada perangkat masing-masing.

6. Membuat Database

Buat database dengan nama buku_tamu_digital melalui phpMyAdmin, MySQL client, atau perangkat pengelola database lainnya.

Jika MySQL client telah tersedia, gunakan perintah:

CREATE DATABASE buku_tamu_digital;

Pastikan database berhasil dibuat sebelum melanjutkan ke tahap berikutnya.

7. Menjalankan Migration dan Seeder

Jalankan migration untuk membuat struktur tabel database.

Kemudian jalankan seeder untuk memasukkan data awal.

Pastikan nama migration, seeder, dan urutan eksekusinya sesuai dengan implementasi project. Jika seeder membutuhkan data atau konfigurasi tambahan, sesuaikan terlebih dahulu.

8. Menjalankan Aplikasi

Jalankan server pengembangan CodeIgniter 4.

Setelah server berjalan, buka browser dan akses alamat.

Aplikasi siap digunakan apabila konfigurasi database, dependensi, dan proses inisialisasi telah berhasil diselesaikan.

⚙️ Konfigurasi Tambahan

1. Integrasi WAKITA (WhatsApp Gateway)

Untuk menggunakan fitur integrasi WAKITA, tambahkan konfigurasi berikut ke dalam file .

Ganti nilai api-key-anda dengan API key yang valid sesuai akun WAKITA yang digunakan.

Simpan API key di dalam file environment dan jangan membagikannya secara publik atau memasukkannya ke repository.

2. Mengubah Warna Utama

Warna utama aplikasi dapat diubah melalui menu:

Admin - Pengaturan - Konfigurasi Sistem - Warna Utama

Warna yang dipilih digunakan sebagai warna tema untuk komponen antarmuka yang telah terhubung dengan konfigurasi tema, seperti tombol, sidebar, kartu, dan grafik.

📁

Struktur di atas merupakan gambaran umum. Susunan direktori dan nama file dapat disesuaikan dengan implementasi project yang sebenarnya.

🔒 Keamanan Sistem

Aplikasi dirancang dengan memperhatikan keamanan data dan pembatasan akses pengguna. Mekanisme keamanan yang diterapkan meliputi:

CSRF Protection: Melindungi form dari permintaan lintas situs yang tidak diinginkan melalui token CSRF.

Password Hashing: Menyimpan kata sandi dalam bentuk hash menggunakan password_hash() dengan algoritma bcrypt.

Session Regeneration: Memperbarui session setelah login untuk membantu mengurangi risiko session fixation.

XSS Prevention: Melakukan escaping terhadap output menggunakan fungsi esc() sesuai konteks penggunaannya.

SQL Injection Prevention: Memanfaatkan Query Builder dan parameter binding untuk membantu mencegah injeksi SQL.

Role-Based Access Control: Membatasi akses halaman dan fitur berdasarkan peran pengguna.

Upload Validation: Memvalidasi tipe MIME, ekstensi, dan ukuran file yang diunggah.

Activity Log: Mencatat aktivitas penting pengguna untuk kebutuhan pemantauan dan audit.

Data Masking: Menyamarkan nomor telepon dan informasi identitas tertentu pada daftar umum.

Error Pages: Menyediakan halaman penanganan kesalahan untuk kode HTTP 403, 404, dan 500.

Catatan keamanan: Daftar di atas menjelaskan mekanisme yang direncanakan atau diklaim tersedia dalam aplikasi. Pastikan setiap mekanisme telah diterapkan dan diuji pada kode sumber sebelum menyatakan bahwa sistem sepenuhnya aman. Untuk penggunaan produksi, konfigurasi environment, validasi otorisasi di sisi server, keamanan upload, dan perlindungan data pribadi juga perlu diperiksa.

📝 Panduan Penggunaan

1. Administrator

Login menggunakan akun administrator yang telah disiapkan.

Kelola data master, termasuk pegawai, departemen, tujuan kunjungan, dan pengguna.

Atur identitas institusi, warna utama, serta konfigurasi sistem melalui menu Pengaturan.

Pantau aktivitas kunjungan melalui Dashboard.

Kelola dan periksa data kunjungan melalui menu Data Kunjungan.

Buat laporan berdasarkan periode yang dibutuhkan dan ekspor laporan ke format PDF atau Excel.

2. Petugas

Login menggunakan akun petugas.

Pantau kunjungan aktif melalui Dashboard.

Periksa daftar dan detail kunjungan tamu.

Buka menu Scan QR untuk memproses check-out tamu.

Akses menu Riwayat Kunjungan untuk melihat kunjungan yang telah selesai.

3. Tamu

Buka halaman kiosk pada perangkat yang tersedia.

Pilih menu Mulai Registrasi.

Isi informasi identitas yang diminta.

Pilih tujuan kunjungan.

Ambil foto menggunakan kamera atau unggah foto jika diperlukan.

Bubuhkan tanda tangan digital pada area yang disediakan.

Selesaikan proses registrasi dan simpan QR Code yang ditampilkan.

Tunjukkan QR Code kepada petugas ketika akan melakukan check-out.

🧪 Pengujian Aplikasi

CodeIgniter 4 menyediakan dukungan pengujian aplikasi. Untuk menjalankan pengujian, gunakan perintah berikut jika konfigurasi testing dan dependensi yang dibutuhkan telah tersedia:

php spark test

Pastikan lingkungan pengujian, konfigurasi database, dan dependensi pengujian telah disiapkan sebelum menjalankan perintah tersebut.

🤝 Kontribusi

Project ini dikembangkan untuk keperluan magang. Kontribusi untuk pengembangan lebih lanjut dapat dilakukan melalui langkah-langkah berikut:

Fork repository.

Buat branch baru untuk fitur atau perbaikan yang akan dikembangkan.

git checkout -b fitur-baru

Lakukan perubahan pada kode sumber.

Simpan perubahan menggunakan commit.

git add .
git commit -m "Menambahkan fitur baru"

Push branch ke repository.

git push origin fitur-baru

Buat Pull Request untuk mengajukan perubahan.

Setiap kontribusi sebaiknya mengikuti struktur kode dan standar pengembangan yang digunakan dalam project.

📄 Lisensi

Project ini dibuat untuk keperluan magang. Penggunaan, distribusi, atau pengembangan ulang di luar konteks tersebut perlu mendapatkan izin dari penulis, kecuali ditentukan lain melalui ketentuan lisensi tertulis.
