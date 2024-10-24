#!/bin/bash

# Créer un réseau Docker pour connecter MySQL et Dolibarr
docker network create dolibarr-network

# Démarrer le conteneur MySQL
docker run --name dolibarr-mysql --network dolibarr-network -e MYSQL_ROOT_PASSWORD=root -e MYSQL_DATABASE=dolibarr -d mysql:5.7

# Démarrer le conteneur Dolibarr
docker run --name dolibarr-app --network dolibarr-network -e DOLI_DB_HOST=dolibarr-mysql -e DOLI_DB_NAME=dolibarr -e DOLI_DB_USER=root -e DOLI_DB_PASSWORD=root -p 8080:80 -d dolibarr/dolibarr

# Afficher un message de succès
echo "Installation terminée ! Accédez à Dolibarr à l'adresse : http://localhost:8080"
 
