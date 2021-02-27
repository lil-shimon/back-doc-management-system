#!/bin/sh

SCRIPT_DIR=$(
    cd $(dirname $0)
    pwd
)

cd $SCRIPT_DIR

#projectRootに移動
cd ../

echo ">>>>>>>>git pull>>>>>>>>"
git pull

cd ./docker

docker-compose -f docker-compose.prod.yml up -d

echo ">>>>>>>>build実行中>>>>>>>>"
docker-compose exec workspace bash -c " 
    composer dump-autoload
    php artisan config:clear
    php artisan route:clear
    php artisan cache:clear
    composer install
    php artisan migrate --force
    npm install
    npm run dev
"
