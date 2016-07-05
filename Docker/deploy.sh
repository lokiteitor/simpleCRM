#!/bin/bash
docker run -d -p 3306:3306 --name CRM-DB -e MYSQL_ROOT_PASSWORD=fd19feba547 -e MYSQL_DATABASE=VANTECRM -e MYSQL_USER=vantec -e MYSQL_PASSWORD=wlp0s29f7u1 mariadb:latest

docker run -d -p 80:80 --name CRM-HTTP --privileged=true -v "$PWD/../CRM/":/var/www/html -v "$PWD/logs/":/var/log/apache2/ --link CRM-DB:mysql lokiteitor:laravel

#docker run -it --link CRM-DB:mysql --rm mariadb:latest sh -c 'exec mysql -h"$MYSQL_PORT_3306_TCP_ADDR" -P"$MYSQL_PORT_3306_TCP_PORT" -uroot -p"$MYSQL_ENV_MYSQL_ROOT_PASSWORD"'
