#!/bin/bash

GREEN="\033[0;32m"
DOCKER_COMMAND="docker-compose exec --user=laradock workspace"

cp .env.example .env
cp .env.laradock laradock/.env
cp nginx.conf laradock/nginx/sites/default.conf

cd laradock
docker-compose up -d --build nginx mysql redis
$DOCKER_COMMAND composer install
$DOCKER_COMMAND php /var/www/artisan key:generate
$DOCKER_COMMAND php /var/www/artisan migrate
$DOCKER_COMMAND npm install
$DOCKER_COMMAND npm run build
echo -e "\n${GREEN}Your application is ready! Please navigate to https://127.0.0.1"
