ARTISAN = php artisan

# Init file
.PHONY: package start clear-cache cache controller api resource model migration seeder base util dump middleware fresh seed

first : migrate start

migrate: fresh seed

clear: clear-cache cache

init:
	composer install
	@cp .env.example .env
	${ARTISAN} key:generate

start:
	${ARTISAN} serve

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
	${ARTISAN} make:resource API/$$resource

# Create new model
model:
	@read -p 'Model name: ' model; \
	${ARTISAN} make:model $$model -mfc

# Create new migration
migration:
	@read -p 'Migration name: ' migration;
	@read -p 'Table target : ' table; \
	${ARTISAN} make:migration $$migration --table=$$table

fresh:
	${ARTISAN} migrate:fresh

seed:
	${ARTISAN} db:seed

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

custom:
	@read -p 'Custom name: ' custom; \
	${ARTISAN} make:custom $$custom

test:
	@read -p 'Test name: ' test; \
	${ARTISAN} make:test $$test --unit

runTest:
	${ARTISAN} test --testsuite=Unit

seeRoute:
	${ARTISAN} route:list

tinker:
	${ARTISAN} tinker
