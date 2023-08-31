ARTISAN = php artisan

# Init file
.PHONY: package start clear-cache cache controller api resource model migration seeder base util dump middleware

first : migrate start

init:
	composer install
	@cp .env.example .env
	${ARTISAN} key:generate

start:
	${ARTISAN} serve --port=8000

clear-cache:
	${ARTISAN} cache:clear
	${ARTISAN} config:clear
	${ARTISAN} route:clear
	${ARTISAN} view:clear

cache:
	${ARTISAN} config:cache
	${ARTISAN} route:cache
	${ARTISAN} view:cache

# Create new controller
controller:
	@read -p 'Controller name: ' controller; \
	${ARTISAN} make:controller API/$$controller

api:
	@read -p 'API Controller name: ' controller; \
	${ARTISAN} make:controller $$controller --api

resource:
	@read -p 'Resource name: ' resource; \
	${ARTISAN} make:resource $$resource

# Create new model
model:
	@read -p 'Model name: ' model; \
	${ARTISAN} make:model $$model -mfc

# Create new migration
migration:
	@read -p 'Migration name: ' migration; \
	@read -p 'Table target : ' table; \
	${ARTISAN} make:migration $$migration --table=$$table

migrate:
	${ARTISAN} migrate:fresh --seed

# Create new seeder
seeder:
	@read -p 'Seeder name: ' seeder; \
	${ARTISAN} make:seeder $$seeder

base:
	@read -p 'Base type: ' base; \
	mkdir ./app/$$base; \
	touch ./app/$$base/Base$$base.php;

util:
	@read -p 'Util name: ' util; \
	touch ./app/Utils/$$util.php;

dump:
	composer dump-autoload

# Create new middleware
middleware:
	@read -p 'Middleware name: ' middleware; \
	${ARTISAN} make:middleware $$middleware
