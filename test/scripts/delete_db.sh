#!/bin/bash

# Variables
CONTAINER_NAME="test_mariadb_1"
DB_NAME="dolibarr"
DB_USER="root"
DB_PASSWORD="root"

# Se connecter à MariaDB pour supprimer l'ancienne base
echo "Suppression de l'ancienne base de données $DB_NAME..."
docker exec -i $CONTAINER_NAME mysql -u $DB_USER -p$DB_PASSWORD -e "DROP DATABASE IF EXISTS $DB_NAME;"

# Créer une nouvelle base de données vide
echo "Création d'une nouvelle base de données $DB_NAME..."
docker exec -i $CONTAINER_NAME mysql -u $DB_USER -p$DB_PASSWORD -e "CREATE DATABASE $DB_NAME;"

# Vérification
if [ $? -eq 0 ]; then
  echo "Base de données $DB_NAME supprimée et recréée avec succès."
else
  echo "Erreur lors de la suppression ou création de la base de données."
fi

