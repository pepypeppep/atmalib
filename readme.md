<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Installation

1. Install Laravel package
```composer
composer install
```
2. Setting the .env file
3. Generate Encryption Key Laravel
```
php artisan key:generate
```
4. Migrate database and generate dummy data with Laravel seeder
```
php artisan migrate --seed
```
5. Seeder will generate 5 Users and 15 Books data
```
Username: atma_user1, atma_user2, atma_user3, atma_user4, atma_user5
Password: qwerty123
```
## Usage
1. Start the Laravel service
```
php artisan serve
```
2. Login user to generate Token for access resources
```php
Method → (POST)
http://127.0.0.1:8000/api/login
Request:
* username (required) → post parameter
* password (required) → post parameter
```
3. Get Token

![Token Image](https://i.imgur.com/jdJFhVT.png)

4. Get Books

- Default
```php
Method → (GET)
http://127.0.0.1:8000/api/books/?token_key=TOKEN
```
- With limit
```php
Method → (GET)
http://127.0.0.1:8000/api/books/?token_key=TOKEN&limit=5
```
- With page number
```php
Method → (GET)
http://127.0.0.1:8000/api/books/?token_key=TOKEN&limit=5&page=2
```
5. Get Book Detail
```php
Method → (GET)
http://127.0.0.1:8000/api/books/BOOK_ID?token_key=TOKEN
```
6. Add New Book
```php
Method → (POST)
http://127.0.0.1:8000/api/books/add?token_key=TOKEN
* title (required) → post parameter
* content (required) → post parameter
```
7. Edit Book Detail
```php
Method → (POST)
http://127.0.0.1:8000/api/books/BOOK_ID/edit?token_key=TOKEN
* title (required) → post parameter
* content (required) → post parameter
```
8. Delete Book Data
```php
Method → (GET)
http://127.0.0.1:8000/api/books/BOOK_ID/delete?token_key=TOKEN
```

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
