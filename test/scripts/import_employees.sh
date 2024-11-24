#!/bin/bash

# Nom du conteneur Web
CONTAINER_NAME="test_web_1"

# Vérifier si le conteneur est en cours d'exécution
if docker ps | grep -q "$CONTAINER_NAME"; then
  echo "Conteneur $CONTAINER_NAME trouvé et en cours d'exécution."

  # Exécution du script d'importation des employés dans le conteneur
  echo "Exécution du script d'importation des employés..."
  docker exec -it $CONTAINER_NAME php /var/www/documents/import_employees.php

  # Vérifier si l'importation a réussi
  if [ $? -eq 0 ]; then
    echo "Importation des employés terminée avec succès."
  else
    echo "Erreur lors de l'importation des employés."
  fi
else
  echo "Erreur : Le conteneur $CONTAINER_NAME n'est pas en cours d'exécution."
fi

