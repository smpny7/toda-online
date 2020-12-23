#!/bin/sh

PS3='>> '

select word in 'Build Docker Environment' 'Execute Bash Command' 'Clear Cache' 'Install FFmpeg' 'Down Containers'
do
  case $REPLY in
    1 ) cd ./laradock
        docker-compose up -d php-fpm nginx mysql
        break ;;

    2 ) cd ./laradock
        docker-compose exec workspace bash
        break ;;

    3 ) cd ./laradock
        docker-compose exec workspace bash -c "
        php artisan cache:clear &&
        php artisan config:clear &&
        php artisan config:cache &&
        php artisan route:clear &&
        php artisan view:clear &&
        php artisan clear-compiled &&
        php artisan optimize &&
        composer dump-autoload &&
        rm -f bootstrap/cache/config.php"
        break ;;

    4 ) cd ./laradock
        docker-compose exec php-fpm apt-get update
        docker-compose exec php-fpm apt-get install -y ffmpeg
        break ;;

    5 ) cd ./laradock
        docker-compose down
        break ;;

    * ) break ;;
  esac
done
