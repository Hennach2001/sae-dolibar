#!/bin/bash

echo "Importation des données en cours..."

# Importer les données dans la base Dolibarr
docker exec -i $(docker-compose ps -q mariadb) mysql -u dolibarr_user -puserpassword dolibarr <<MYSQL_SCRIPT
LOAD DATA LOCAL INFILE '/path/to/clients.csv'
INTO TABLE llx_societe
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\n'
(nom, adresse, ville, pays, telephone);
MYSQL_SCRIPT

echo "Importation terminée."

