Pertama-tama, kita perlu membuat file .env berdasarkan dari file env.example
nama database : db_blog
---------------------------------------
Berikutnya, kita instal package-package yang diinstal dalam composer di mana package tersebut akan disimpan dalam folder vendor. Jalankan perintah berikut di dalam command prompt atau terminal:

(composer install)
----------------------------------------

Setelah berhasil membuat file .env, berikutnya jalankan perintah berikut:

php artisan key:generate

Perintah ini akan meng-generate keyuntuk dimasukkan ke APP_KEY di file .env

Kemudian, jika aplikasi Laravel tersebut memiliki database, buatlah nama database baru. Lalu sesuaikan nama database, username, dan password database di file .env.
---------------------------------------
Berikutnya jalankan perintah berikut:

php artisan migrate:fresh --seed
untuk mengenarete isi database beserta data yang diinputkan
---------------------------------------
Terakhir, untuk membukanya di web browser, jalankan perintah:

php artisan serve

untuk yang belum ada valet
---------------------------------------
untuk menambahkan table cek ke dalam file migration
folder migration untuk menambah table

dan isi data atau isi dalam table cek folder seeders
disana untuk pembuatan isi table atau datanya
---------------------------------------
// protected $guarded untuk memproteksi pengisian data kedalam database dimana yang tidak boleh diisi adalah id
// protected $fillable untuk membolehkan pengisian data apa saja yng diinputkan kedalam database

cek folder model untuk menambahkan relasi /relation data antar table menggunakan foreign key

dan folder factories untuk genrate data random hanya schemanya saja