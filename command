#!/bin/bash

if [ "$1" = "build" ]
then
  cp docker/example.env docker/.env
  cd docker && docker-compose up --build -d

  echo 'Composer install'
  echo '----------------'
  docker exec -it quest-cli composer install

  echo 'Create DB'
  echo '----------------'
  docker exec -it quest-cli symfony console doctrine:database:create

  echo 'Migrations run'
  echo '----------------'
  docker exec -it quest-cli symfony console doctrine:migrations:migrate

  echo 'Fixtures load'
  echo '----------------'
  docker exec -it quest-cli symfony console doctrine:fixtures:load
fi

if [ "$1" = "questions" ]
then
  docker exec -it quest-cli symfony console app:questions
fi

if [ "$1" = "up" ]
then
  cd docker && docker-compose up -d
fi

if [ "$1" = "stop" ]
then
  cd docker && docker-compose stop
fi

if [ "$1" = "down" ]
then
  cd docker && docker-compose down
fi