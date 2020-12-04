#!/bin/sh

PS3='>> '

select word in 'Build Docker Environment' 'Execute Bash Command'
do
  case $REPLY in
    1 ) cd ./laradock
        docker-compose up -d php-fpm nginx mysql
        break ;;

    2 ) cd ./laradock
        docker-compose exec workspace bash
        break ;;

    * ) break ;;
  esac
done
