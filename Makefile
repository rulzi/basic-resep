build:
	composer install
	php artisan migrate:fresh --seed
	php artisan storage:link
	php artisan key:generate
	php artisan jwt:secret
test:
	php ./vendor/bin/phpunit