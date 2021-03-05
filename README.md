# Bilemo

<a href="https://codeclimate.com/github/sjaulin/bilemo/maintainability"><img src="https://api.codeclimate.com/v1/badges/a79f77d55c8aa844b1f6/maintainability" /></a>

### Create SSH Keys
In config/jwt :
```
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

## Installation

1. Configure file .env.local using file .env.local.example as a template.

2. Install dependancies :
```
composer install
```
3. Create the database if not exist
```
php bin/console doctrine:database:create
```
4. Create database tables
```
php bin/console doctrine:migrations:migrate
```
5. If necessary, create fake content and demo users
```
php bin/console doctrine:fixtures:load --env=dev --group=app
```
6. Once ready for production, modify the environment in .env file
```
# ./.env
APP_ENV=prod
```