#!/bin/bash
# run
# chmod +x start.sh
# to give this file execute permission

PROJECT_PATH="/home/david/development/training/guess-game/udemy-guesses"

rm ${PROJECT_PATH}/migrations/*.php

docker-compose up -d