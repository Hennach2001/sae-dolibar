#!/bin/bash

# Nom du conteneur web
CONTAINER_NAME="test_web_1"

# Exécuter le script d'exportation PHP dans le conteneur
echo "Lancement de l'exportation des employés vers un fichier CSV..."
docker-compose exec web php /var/www/test/scripts/export_employees.php

# Vérifier si l'exécution a réussi
if [ $? -eq 0 ]; then
    echo "Exportation des employés réussie."
else
    echo "Erreur lors de l'exportation des employés."
    exit 1
fi

# Copier le fichier CSV généré du conteneur vers l'hôte
docker cp $CONTAINER_NAME:/var/www/test/data/employes_export.csv ./employes_export.csv

# Vérifier si le fichier a été copié avec succès
if [ -f ./employes_export.csv ]; then
    echo "Fichier CSV exporté avec succès : ./employes_export.csv"
else
    echo "Erreur lors de la copie du fichier CSV."
    exit 1
fi

