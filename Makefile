up:
	docker-compose up -d
nuke:
	docker-compose down --rmi all --remove-orphans
build:
	docker-compose build --no-cache
rebuild:
	make nuke
	make build
	make up
shell:
	docker-compose exec web sh
test:
	docker-compose exec web php artisan migrate:refresh --env=testing
	docker-compose exec web ./vendor/bin/phpunit
test-one:
	docker-compose exec web ./vendor/bin/phpunit --filter="$(file)"
db-migrate:
	docker-compose exec web php artisan migrate
db-rollback:
	docker-compose exec web php artisan migrate:rollback
db-seed:
	docker-compose exec web php artisan db:seed
db-refresh:
	docker-compose exec web php artisan migrate:reset
	docker-compose exec web php artisan migrate
	docker-compose exec web php artisan db:seed
lint:
	docker-compose exec web ./vendor/bin/php-cs-fixer fix ./ --dry-run
fix:
	docker-compose exec web ./vendor/bin/php-cs-fixer fix ./