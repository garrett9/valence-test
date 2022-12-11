#!/bin/bash

cd laradock
docker-compose up -d --build nginx mysql redis
docker-compose -f docker-compose.yml exec --user=laradock workspace php /var/www/artisan migrate
echo -e "\n\033[0;32mYour application is ready! Please navigate to https://127.0.0.1"
