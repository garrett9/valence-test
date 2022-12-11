#!/bin/bash

DOCKER_COMMAND="docker-compose -f laradock/docker-compose.yml exec --user=laradock workspace"

$DOCKER_COMMAND ${@:1}
