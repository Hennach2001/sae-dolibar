#!/bin/bash

# Variables
CONTAINER_NAME="test_mariadb_1"
SQL_FILE_PATH="$HOME/sae-dolibarr/test/scripts/dolibarr_export.sql"
CONTAINER_SQL_PATH="/tmp/dolibarr_export.sql"
DB_NAME="dolibarr"
DB_USER="root"
DB_PASSWORD="root"

# Vérifier si le fichier d'exportation existe
if [ -f $SQL_FILE_PATH ]; then
  echo "Fichier d'exportation trouvé : $SQL_FILE_PATH"
  
  # Copier le fichier SQL dans le conteneur
  echo "Copie du fichier d'exportation dans le conteneur..."
  docker cp $SQL_FILE_PATH $CONTAINER_NAME:$CONTAINER_SQL_PATH

  # Vérifier si la copie a réussi
  if [ $? -eq 0 ]; then
    echo "Fichier copié avec succès dans le conteneur."

    # Restauration de la base de données à partir du fichier SQL
    echo "Restauration de la base de données $DB_NAME..."
    docker exec -i $CONTAINER_NAME mysql -u $DB_USER -p$DB_PASSWORD $DB_NAME < $CONTAINER_SQL_PATH

    # Vérifier si la restauration a réussi
    if [ $? -eq 0 ]; then
      echo "Restauration terminée avec succès."

      # Vérifier les tables dans la base restaurée
      echo "Vérification des tables dans la base de données $DB_NAME..."
      docker exec -i $CONTAINER_NAME mysql -u $DB_USER -p$DB_PASSWORD -e "SHOW TABLES;" $DB_NAME

      # Optionnel : Vérification de quelques données
      echo "Vérification des données dans la table llx_user..."
      docker exec -i $CONTAINER_NAME mysql -u $DB_USER -p$DB_PASSWORD -e "SELECT * FROM llx_user LIMIT 5;" $DB_NAME

    else
      echo "Erreur lors de la restauration de la base de données."
    fi
  else
    echo "Erreur lors de la copie du fichier dans le conteneur."
  fi
else
  echo "Erreur : Le fichier d'exportation n'existe pas : $SQL_FILE_PATH"
fi

