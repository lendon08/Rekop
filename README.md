# No Name Yet
Online Work 

## Setup
Make sure to install [composer](https://getcomposer.org/download/) and [nodejs](https://nodejs.org/en)

Install Dependencies:
```
composer install
```

```
npm install
```

```
php artisan key:generate
```

## Migrate and Seed the Database
```
php artisan migrate:fresh --seed
```

## Run the code
```
php artisan serve
```

```
npm run dev
```

## Before Production Deployment(Warning don't do it in Developement)
```
php artisan config:cache
```

>If you execute the php artisan config:cache command during your deployment process, you should be sure that you are only calling the env function from within your configuration files. Once the configuration has been cached, the .env file will not be loaded; therefore, the env function will only return external, system level environment variables.


After deployment install this [Laravel Backup](https://spatie.be/docs/laravel-backup/v8/introduction)
