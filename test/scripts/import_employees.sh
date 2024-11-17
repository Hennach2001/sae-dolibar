#!/bin/bash

# Nom du conteneur web
CONTAINER_NAME="test_web_1"

# Vérifier si le fichier CSV existe dans le conteneur
CSV_FILE="/var/www/test/data/employes.csv"

if [ ! -f $CSV_FILE ]; then
    echo "Le fichier CSV n'existe pas à l'emplacement $CSV_FILE."
    exit 1
fi

# Exécuter le script d'importation PHP dans le conteneur
echo "Lancement de l'importation des employés depuis le fichier CSV..."
docker-compose exec web php /var/www/test/scripts/import_employees.php

# Vérifier si l'exécution a réussi
if [ $? -eq 0 ]; then
    echo "Importation des employés réussie."
else
    echo "Erreur lors de l'importation des employés."
    exit 1
fi

