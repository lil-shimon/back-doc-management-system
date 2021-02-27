#!/bin/bash

SCRIPT_DIR=$(
    cd $(dirname $0)
    pwd
)

print_style() {

    if [ "$2" == "info" ]; then
        COLOR="96m"
    elif [ "$2" == "success" ]; then
        COLOR="92m"
    elif [ "$2" == "warning" ]; then
        COLOR="93m"
    elif [ "$2" == "danger" ]; then
        COLOR="91m"
    else #default color
        COLOR="0m"
    fi

    STARTCOLOR="\e[$COLOR"
    ENDCOLOR="\e[0m"

    printf "$STARTCOLOR%b$ENDCOLOR" "$1"
}


# もしコンテナが起動していなかったら起動する
upDockerContainer() {
    cd $SCRIPT_DIR
    cd ../docker

    docker-compose down

    CONTAINERS=$(docker ps | awk '{print $2}')
    if
        [[ $CONTAINERS == *nginx* ]]
        [[ $CONTAINERS == *php-fpm* ]]
        [[ $CONTAINERS == *phpmyadmin* ]]
        [[ $CONTAINERS == *workspace* ]]
        [[ $CONTAINERS == *mysql* ]]
    then
        echo "docker container is already started"
    else
        echo "docker container is starting"
        docker-compose restart
        docker-compose up -d
    fi
}

# プロジェクトルート/dockerにいるときに実行してください
startFrontEnd() {
    upDockerContainer

    cd $SCRIPT_DIR
    cd ../docker

    docker-compose exec workspace sh -c " 
        cd frontend &&
        npm run start
    "
}

setUp() {
    upDockerContainer

    cd $SCRIPT_DIR
    cd ../
    cp .env.example .env
    cd ./docker
    cp .env.example .env

    shift # backendの初期設定など設定中
    docker-compose exec workspace sh -c " 
        composer install
        npm install
        php artisan key:generate
        php artisan jwt:secret
        php artisan migrate --seed
    "
}

print_style "setup中です\n" "info"

print_style "docker_container生成中です。\n" "info"
print_style "この作業には最長で30分~１時間程度かかります\n" "info"

setUp
