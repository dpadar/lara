lara
====
To deploy an application:
------
- install required composer and node packages
```composer install```
```npm install```
- compile javascript and assets by running
```npm run production```
- configure database connection in ```.env```
- configure sanctum stateful domains in ```config/sanctum.php```
- disable debug in ```config/app.php```
- you should also do steps from laravel's [guide](https://laravel.com/docs/8.x/deployment#introduction)
