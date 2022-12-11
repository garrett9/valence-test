#!/bin/bash

docker-compose -f laradock/docker-compose.yml exec --user=laradock workspace zsh && cd /var/www
