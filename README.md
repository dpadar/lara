lara
====
To play with application
------
- create ```.env``` file and configure few needed things:
```
APP_NAME=Laravel
APP_KEY=
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
```
- in the same file configure database connection
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=lara
DB_USERNAME=lara
DB_PASSWORD=croft
```
- run docker-compose using sail ```./vendor/bin/sail up```
- run migrations ```./vendor/bin/sail artisan migrate```
- populate database with needed info ```./vendor/bin/sail artisan db:seed```
- optionally populate database with users
```
[user]$ ./vendor/bin/sail artisan tinker
>>> User::factory()->count(30)->create();
```

To deploy an application:
------
- create ```.env``` file and configure few needed things:
```
APP_NAME=Laravel
APP_KEY=
APP_ENV=production
APP_DEBUG=false
APP_URL=http://url-to-use
```
- in the same file configure database connection
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=lara
DB_USERNAME=lara
DB_PASSWORD=croft
```
- run docker-compose using sail ```./vendor/bin/sail up```
- run migrations ```./vendor/bin/sail artisan migrate```
- populate database with available countries and admin user
- configure sanctum stateful domains in ```config/sanctum.php```
- you should also do steps from laravel's [guide](https://laravel.com/docs/8.x/deployment#introduction)
