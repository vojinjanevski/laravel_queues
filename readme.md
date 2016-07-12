# Instructions on how to start this

run standard laravel commands
* composer install
* npm install
* php artisan migrate\
* in .env config set QUEUE_DRIVER=database

## Start workers

open couple of terminals and run on each one following command
```
php artisan queue:listen database
```

open browser and make couple requests to /start or you can just run the ExampleTest
