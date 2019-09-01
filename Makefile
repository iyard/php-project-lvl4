test:
	- composer run-script phpunit tests

install:
	- composer install

run:
	- php artisan serve

lint:
	composer run-script phpcs -- --standard=PSR12 app routes
