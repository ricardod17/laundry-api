API Laundry dibuat dengan menggunakan
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## About App
<b>About App</b>
Aplikasi ini dibuat untuk mendukung proses operasional Laundry, masi terdapat beberapa kekurangan yang dapat dilakukan improvement, aplikasi dibangun dengan Laravel 8.4 dengan PHP 7.X. Aplikasi ini terdapat beberapa module, yaitu :
- Jasa, CRUD berupa membuat produk seperti Laundry Kiloan beserta harganya.
- Transaksi, untuk membuat transaksi yang dapat dilakukan oleh pengguna. Admin dapat melakukan update status menjadi Processing.
- User, untuk dapat melakukan CRUD terhadap User Management yang memiliki Role, dan User

- Login, dapat melakukan login dengan JWT Authentication menggunakan bearer token.
- Register, dapat melakukan register sebagai member untuk melakukan pemesanan.

Aplikasi masih memiliki kekurangan dari sisi role management karena saya mengalami kesulitan didalam melakukan pemisahan antara middleware dan jwt untuk sistemnya.

<b>How To Run</b>
- Please run mysql on XAMPP
- Please setting database connection .env.example
- Open Using Git Hash
- PHP artisan migrate
- PHP artisan db:seed
- PHP artisan serve
- go to localhost:8000/api
- API : Jasa/Transaksi/User
Login / Register :
- Method POST utk login : localhost:8000/login
- Method POST utk register : localhost:8000/register
- Lalu copy authenticated token untuk dapat mengakses module.

Jasa / Transaksi / Users (perlu login):
- Method GET utk meretrieve data : localhost:8000/api/jasa/1
- Method POST utk mencreate data : localhost:8000/api/jasa/
- Method POST utk mengupdate data : localhost:8000/api/jasa/1
- Method DELETE utk menghapus data : localhost:8000/api/jasa/1

## About Laravel
<b>About Laravel</b>
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
