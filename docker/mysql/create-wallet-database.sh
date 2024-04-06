#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS wallet;
    GRANT ALL PRIVILEGES ON \`wallet%\`.* TO '$MYSQL_USER'@'%';
EOSQL
