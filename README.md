# CS301-backend

## Live Link

http://salty-coast-16931.herokuapp.com/

## Tech

-   PHP (Laravel)

## Setup Dev Environment

1. Setup database and seed sample products. Run in terminal/cmd:

```
php artisan migrate:fresh --seed
```

2. Setup keys for authentication. Run in terminal/cmd:

```
php artisan passport:install --force
```

3. Clear caches (if necessary). Run in terminal/cmd:

```
php artisan cache:clear
php artisan route:cache
```

4. Start server. Run in terminal/cmd:

```
php artisan serve
```
