#!/bin/bash
docker run --name CRM-DB --privileged=true -e MYSQL_ROOT_PASSWORD=fd19feba547 -e MYSQL_DATABASE=VANTECRM -e MYSQL_USER=vantec -e MYSQL_PASSWORD=wlp0s29f7u1 -v "$PWD/../SQL/":/var/lib/mysql --rm mariadb:latest
