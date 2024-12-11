project = template

in:
	docker exec -it "$(project)-php-fpm-1" /bin/bash

build:
	docker-compose up -d

rebuild:
	docker-compose down
	docker-compose build
	docker-compose up -d

tail:
	@docker compose logs --follow

install-laravel:
	composer create-project laravel/laravel

laravel-chmod:
	@chmod o+w ./storage/ -R


