#!/bin/sh

PS3='>> '

select word in 'Build Docker Environment' 'Execute Bash Command' 'Install FFmpeg' 'Down Containers'
do
  case $REPLY in
    1 ) cd ./laradock
        docker-compose up -d php-fpm nginx mysql
        break ;;

    2 ) cd ./laradock
        docker-compose exec workspace bash
        break ;;

    3 ) cd ./laradock
        docker-compose exec php-fpm apt-get update
        docker-compose exec php-fpm apt-get install ffmpeg
        break ;;

    4 ) cd ./laradock
        docker-compose down
        break ;;

    * ) break ;;
  esac
done
