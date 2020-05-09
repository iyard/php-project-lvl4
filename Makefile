test:
	- composer run-script phpunit tests

install:
	- composer install

run:
	- php artisan serve

lint:
	composer run-script phpcs -- --standard=PSR12 app routes tests

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n
