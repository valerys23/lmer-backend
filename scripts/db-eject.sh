#!/usr/bin/env bash

MYSQL_CONTAINER_ID=$(docker ps -qf "name=db_virt")
DUMP_FILENAME=virt-mysql-dump-$(date +"%Y-%m-%d_%H-%M-%S").sql.gz

echo "Container ID: $MYSQL_CONTAINER_ID"

mkdir -p mysql-dumps

docker exec -i -e MYSQL_PWD=password $MYSQL_CONTAINER_ID mysqldump --no-tablespaces -u virt virt | gzip > mysql-dumps/$DUMP_FILENAME
