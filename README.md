
# **README : Projet ERP/CRM sous Docker**

Ce projet déploie une solution ERP/CRM avec Dolibarr et MariaDB. Il inclut des scripts pour gérer l’importation/exportation des données et manipuler la base de données avec précision.  

---

## **1. docker-compose.yml**

Ce fichier YAML configure l'environnement Docker pour le projet.  

### **Détails du fichier :**
- **Services définis** :
  - **Dolibarr** : Conteneur utilisant une image Dolibarr tuxgasy/dolibarr.  
  - **MariaDB** : Base de données relationnelle.
- **Ports exposés :**
  - `Dolibarr` : 80 (HTTP).  
  - `MariaDB` : 3306 (MySQL).  
- **Volumes persistants :**
  - `dolibarr_data` : Sauvegarde les fichiers de configuration et documents générés par Dolibarr.  
  - `mariadb_data` : Contient toutes les données de la base.  

### **Commandes utiles :**
- **Lancement** :
  ```bash
  docker-compose up -d
  ```
- **Arrêt** :
  ```bash
  docker-compose down
  ```
- **Recréation des conteneurs sans supprimer les données :**
  ```bash
  docker-compose up --build -d
  ```

---

## **2. docker-init.php**

Un script PHP pour configurer Dolibarr dès son démarrage, notamment en activant les modules nécessaires.

### **Détails du script :**
- **Activation des modules :**
  - Import/Export : Permet de gérer les fichiers tiers.  
  - Sociétés/Tiers : Active la gestion des partenaires commerciaux.  
- **Connexion à la base Dolibarr :**
  - Le script utilise les identifiants par défaut (`root/root`) pour se connecter à MariaDB.  

### **Exemple d’activation de module :**
```php
$module = 'modImportExport';
$db->query("UPDATE llx_const SET value = '1' WHERE name = '$module'");
```

---

## **3. import_employees.php**

Ce script PHP insère des données issues du fichier `employees.csv` dans la table `llx_societe`.  

### **Fonctionnalités détaillées :**
1. **Lecture du fichier CSV :**
   - Utilisation de la fonction `fgetcsv()` pour traiter chaque ligne.  
2. **Connexion à MariaDB :**
   - Via l’extension `mysqli`, avec gestion d’erreurs si la connexion échoue.  
3. **Insertion des données :**
   - Construction de requêtes SQL pour insérer chaque ligne.  

### **Exemple de code d’insertion :**
```php
$name = "John Doe";
$email = "john.doe@example.com";
$query = "INSERT INTO llx_societe (nom, email) VALUES ('$name', '$email')";
mysqli_query($db, $query);
```

### **Exécution manuelle :**
1. Copiez `employees.csv` dans le conteneur :  
   ```bash
   docker cp employees.csv dolibarr_container:/var/www/html/
   ```
2. Lancez le script :  
   ```bash
   docker exec dolibarr_container php /var/www/html/import_employees.php
   ```

---

## **4. import_employees.sh**

Un script shell pour automatiser le processus d’importation des données.

### **Étapes réalisées par le script :**
1. Vérifie que le conteneur Dolibarr est en cours d’exécution.  
2. Copie `employees.csv` dans le conteneur Dolibarr.  
3. Exécute `import_employees.php` dans le conteneur.  

### **Contenu du script :**
```bash
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

```

### **Exécution :**
```bash
chmod +x import_employees.sh
./import_employees.sh
```

---

## **5. export_employees.sh**

Ce script extrait les données de la base MariaDB et les enregistre dans un fichier SQL.  

### **Fonctionnalités détaillées :**
- Exécute une commande `mysqldump` dans le conteneur MariaDB.  
- Sauvegarde le fichier SQL localement sur l’hôte.  

### **Contenu du script :**
```bash
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

```

### **Résultat :**
Un fichier `dolibarr_export.sql` contenant toutes les données exportées.

---

## **6. delete_db.sh**

Réinitialise la base de données en supprimant toutes les tables et en recréant la base. (pour bien tester la restauration)

### **Détails du script :**
1. Exécute une commande SQL pour supprimer la base existante.  
2. Recrée une nouvelle base vide.  

### **Contenu du script :**
```bash
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

```

### **Exécution :**
```bash
chmod +x delete_db.sh
./delete_db.sh
```

---

## **7. restore_db.sh**

Restaure les données d’un fichier SQL (préalablement exporté avec `export_employees.sh`) dans la base Dolibarr.  

### **Fonctionnalités détaillées :**
- Charge le fichier `dolibarr_export.sql` dans le conteneur MariaDB.  
- Exécute le script SQL pour insérer les données.

### **Contenu du script :**
```bash
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

```

### **Exécution :**
```bash
chmod +x restore_db.sh
./restore_db.sh
```

---

## **8. employees.csv**

Ce fichier CSV contient les données à importer dans la table `llx_societe`.

### **Détails du fichier :**
- **Structure :**
  - `name` : Nom de l’employé.  
  - `email` : Adresse email de l’employé.  

- **Exemple de contenu :**
```csv
name,email
John Doe,john.doe@example.com
Jane Smith,jane.smith@example.com
```

---

## **Étapes recommandées pour l’utilisation :**
1. **Démarrez les conteneurs :**
   ```bash
   docker-compose up -d
   ```
   
2. **Importez les données avec `import_employees.sh` :**
   ```bash
   ./import_employees.sh
   ```
3. **Exportez les données :**
   ```bash
   ./export_employees.sh
   ```
5. **Restaurez la base si nécessaire :**
   ```bash
   ./restore_db.sh
   ```

