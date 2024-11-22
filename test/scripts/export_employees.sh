#!/bin/bash

# Informations de connexion à la base de données
DB_USER="root"
DB_PASSWORD="root"
DB_NAME="dolibarr"

# Nom du conteneur Docker MariaDB
CONTAINER_NAME="test_mariadb_1"

# Répertoire de sauvegarde (dans le dossier courant)
BACKUP_DIR="./sauvegarde"

# Nom du fichier de sauvegarde avec horodatage
BACKUP_FILE="$BACKUP_DIR/sauvegarde_$(date +'%Y%m%d_%H%M%S').sql"

# Créer le dossier de sauvegarde s'il n'existe pas
if [ ! -d "$BACKUP_DIR" ]; then
    mkdir -p "$BACKUP_DIR"
    echo "Répertoire de sauvegarde créé : $BACKUP_DIR"
fi

# Commande pour effectuer la sauvegarde
docker exec -i $CONTAINER_NAME mysqldump -u $DB_USER -p$DB_PASSWORD $DB_NAME > $BACKUP_FILE

# Vérification du succès de la sauvegarde
if [ $? -eq 0 ]; then
    echo "Sauvegarde réussie : $BACKUP_FILE"
else
    echo "Erreur lors de la sauvegarde."
    exit 1
fi
