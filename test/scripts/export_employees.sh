#!/bin/bash

# Définir le nom du conteneur MariaDB
CONTAINER_NAME="test_mariadb_1"
EXPORT_FILE_PATH="/tmp/dolibarr_export.sql"
LOCAL_DESTINATION="$HOME/sae-dolibarr/test/scripts/dolibarr_export.sql"

# Accéder au conteneur MariaDB
echo "Accès au conteneur $CONTAINER_NAME..."
docker exec -it $CONTAINER_NAME bash -c "
  # Mettre à jour les paquets dans le conteneur
  echo 'Mise à jour des paquets...'
  apt-get update -y

  # Installer le client MySQL (mysqldump)
  echo 'Installation de mysql-client...'
  apt-get install -y mysql-client

  # Effectuer le dump de la base de données dolibarr
  echo 'Exécution du mysqldump...'
  mysqldump -u root -proot --skip-column-statistics dolibarr > $EXPORT_FILE_PATH

  # Vérifier si le fichier d'exportation existe
  echo 'Vérification de la création du fichier...'
  ls -l $EXPORT_FILE_PATH
"

# Copier le fichier d'exportation depuis le conteneur vers le répertoire local
echo "Copie du fichier d'exportation sur l'hôte..."
docker cp $CONTAINER_NAME:$EXPORT_FILE_PATH $LOCAL_DESTINATION

# Confirmer la réussite de l'opération
if [ -f "$LOCAL_DESTINATION" ]; then
  echo "Le fichier d'exportation a été copié avec succès vers $LOCAL_DESTINATION"
else
  echo "Erreur lors de la copie du fichier d'exportation."
fi

