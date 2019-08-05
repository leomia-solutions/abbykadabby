test:
	docker-compose exec web ./vendor/bin/phpunit
lint:
	docker-compose exec web ./vendor/bin/php-cs-fixer fix ./ --dry-run
fix:
	docker-compose exec web ./vendor/bin/php-cs-fixer fix ./