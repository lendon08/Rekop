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
### Update call history
```
php artisan fetch:call-history
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


