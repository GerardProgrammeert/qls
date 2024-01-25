install_folder = platform
full_platform_path = $(shell pwd)/platform

in:
	docker exec -it laraveldockertemplate-php-fpm-1 /bin/bash

build:
	docker-compose up -d

rebuild:
	docker-compose down
	docker-compose build
	docker-compose up -d

tail:
	@docker compose logs --follow

make-folder:
	@[ -d $(full_platform_path) ] || mkdir -p $(full_platform_path)

remove-dir:
	@[ ! -d $(full_platform_path) ] || rm -R $(full_platform_path)

laravel-reinstall: remove-dir laravel-install rebuild

composer-install-laravel:
	composer create-project laravel/laravel $(install_folder)

laravel-chmod:
	@chmod o+w ./$(install_folder)/storage/ -R

laravel-install: composer-install-laravel laravel-chmod build
	@echo "finished"
