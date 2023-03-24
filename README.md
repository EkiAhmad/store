<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel

hai, untuk instalasi aplikasi ini bisa ikuti step - step berikut

- pertama pull aplikasi ini dan lakukan composer update
- lalu hapus .example pada .env dan ubah DB_DATABASE=store
- lalu buat database MySQL di local dengan nama store
- lalu run php artisan migrate untuk membuat table" yg disediakan
- lalu run php artisan db:seed untuk menambahkan data sample pada table category
- kemudian siapkan postman anda dan import file Product.postman_collection.json
- lalu run php artisan serve dan aplikasi bisa dicoba / digunakan dengan postman
