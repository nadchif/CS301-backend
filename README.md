# CS301-backend

## Live Link

http://salty-coast-16931.herokuapp.com/

## Tech

-   PHP [(Laravel)](https://laravel.com/)

## Setup Dev Environment

1. Setup dependecies using [Composer](https://getcomposer.org/download/). Run in terminal/cmd (in project root):

```
composer install
```

2. Setup database and seed sample products. Run in terminal/cmd:

```
php artisan migrate:fresh --seed
```

3. Setup keys for authentication. Run in terminal/cmd:

```
php artisan passport:install --force
```

4. Clear caches (if necessary). Run in terminal/cmd:

```
php artisan cache:clear
php artisan route:cache
```

5. Start server. Run in terminal/cmd:

```
php artisan serve
```
