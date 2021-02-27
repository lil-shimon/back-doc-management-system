#!/bin/sh

. ../.env


docker run -v "$PWD:/output" --net="host" schemaspy/schemaspy:latest -t mysql -host localhost:$DB_PORT -db $DB_DATABASE -u $DB_USERNAME -p $DB_PASSWORD -connprops useSSL\\=false -s $DB_DATABASE

# docker run -v "$PWD/backend/schemaspy:/output" --net="host" schemaspy/schemaspy:snapshot -t mysql -host $MYSQL_HOST:$MYSQL_PORT -db $MYSQL_DATABASE -u $MYSQL_USER -p $MYSQL_PASS -connprops useSSL\\=false -s information_schema 
