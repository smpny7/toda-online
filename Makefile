setup: ## submoduleの更新とlaradock内に.envファイルを作成してbuild
	git submodule update -i; cp laradock.example.env laradock/.env; make build

restart: ## コンテナの再起動
	make stop; make start

stop: ## コンテナの停止
	cd laradock; docker-compose down

start: ## コンテナの起動
	cd laradock; docker-compose up -d mysql nginx; docker-compose exec php-fpm apt-get update; docker-compose exec php-fpm apt-get install -y ffmpeg

build: ## コンテナのビルド
	cd laradock; docker-compose up -d mysql nginx; docker-compose exec workspace php artisan storage:link
