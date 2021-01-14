lara
====
To play with application
------
- install required composer and node packages
```composer install```
```npm install```
- compile javascript and assets by running
```npm run developer```
- create ```.env``` file and configure few needed things:
```
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
```
- in the same file configure database connection
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=username
DB_PASSWORD=password
```
- run migrations ```php artisan migrate```
- populate database with needed info ```php artisan db:seed```
- optionally populate database with users
```
[user]$ php artisan tinker
>>> User::factory()->count(30)->create();
```
- run ```php artisan serve```

To deploy an application:
------
- install required composer and node packages
```composer install```
```npm install```
- compile javascript and assets by running
```npm run production```
- create ```.env``` file and configure few needed things:
```
APP_NAME=Laravel
APP_ENV=production
APP_DEBUG=false
APP_URL=http://url-to-use
```
- in the same file configure database connection
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_name
DB_USERNAME=username
DB_PASSWORD=password
```
- run migrations ```php artisan migrate```
- populate database with available countries
- configure sanctum stateful domains in ```config/sanctum.php```
- you should also do steps from laravel's [guide](https://laravel.com/docs/8.x/deployment#introduction)
