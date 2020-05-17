test:
	composer run-script phpunit tests

install:
	composer install

run:
	php artisan serve

lint:
	composer phpcs

lint-fix:
	composer phpcbf

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n
