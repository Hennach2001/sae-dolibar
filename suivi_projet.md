# Journal de suivi de projet : Installation d'un ERP/CRM (Dolibarr)

## Chef de projet : HENNACH MOHAMMED  
## Équipe : ALIOUN THIAW, FARHANE ABDESSAMAD  

---

### **Séance n°1 - 16/10, 8h30 - 11h30**  
**Travail effectué :**  
- **Définition des rôles et répartition des tâches :**  
  - Mohammed a été désigné chef de projet et s’occupe de la coordination générale.  
  - Alioun est chargé de la gestion des bases de données (choix, configuration, et suivi de la persistance des données).  
  - Abdessamad prend en charge la documentation technique.  

- **Exploration documentaire sur Dolibarr :**  
  - Alioun et Mohammed ont examiné différentes méthodes pour installer Dolibarr (Docker, packages Linux, fichier source, et VM).  
  - Choix : Docker a été retenu pour sa flexibilité et son déploiement facile.  
  - Version : La version stable 14.0.3 de Dolibarr a été choisie.  

- **Choix de la base de données :**  
  - Alioun a suggéré MariaDB pour sa compatibilité avec Docker et sa simplicité d'intégration.  

**À faire pour la prochaine séance :**  
- Approfondir la documentation technique sur les modules Dolibarr.  
- Préparer une première installation de Dolibarr avec Docker, en intégrant MariaDB.  

---

### **Séance n°2 - 16/10, 13h00 - 16h00**  
**Travail effectué :**  
- **Documentation et choix des modules :**  
  - Abdessamad a recherché les modules adaptés, tels que "Clients/Prospects", "Produits/Services", "contact" et "Facturation".  
  - Il a documenté la liste des modules et leurs configurations de base.  

- **Préparation pour l’installation Docker :**  
  - Alioun a testé plusieurs images Docker, et a retenu l’image `dolibarr/dolibarr:14.0.3`.  

- **générer des fichiers CSV de test :**  
  - Mohammed a généré des fichiers CSV pour simuler une base de données initiale (employes.csv et clients.csv).  

**À faire pour la prochaine séance :**  
- Installer Dolibarr et MariaDB dans Docker.  
- Configurer un réseau Docker pour que Dolibarr et MariaDB puissent communiquer entre eux.  

---

### **Séance n°3 - 17/10, 14h30 - 17h30**  
**Travail effectué :**  
- **Installation de Dolibarr et MariaDB dans Docker :**  
  - Alioun a créé un fichier `docker-compose.yml` pour déployer les conteneurs.  

- **Automatisation initiale de l’installation :**  
  - Abdessamad a développé un script `install.sh` pour démarrer les conteneurs avec les paramètres requis.  

- **Recherche d’une image Docker stable :**  
  - Mohammed a suggéré de remplacer l’image `dolibarr/dolibarr:14.0.3` par une version plus stable après tests.  

**À faire pour la prochaine séance :**  
- Configurer les modules de base via l’interface de Dolibarr.  
- Vérifier la persistance des données dans MariaDB.  

---

### **Séance n°4 - 24/10, 14h30 - 17h30**  
**Travail effectué :**  
- **Prise en main de Dolibarr et activation des modules :**  
  - Alioun a activé les modules "Clients/Prospects" et "conact" "tiere" "import".  

- **Génération de fichiers CSV avec des données fictives :**  
  - Mohammed a enrichi les fichiers `employes.csv` et `clients.csv` avec plus de données réalistes.(utilisation de chat gpt pour generer les donnes)  

**À faire pour la prochaine séance :**  
- Configurer les modules activés pour répondre aux besoins spécifiques.  
- Tester l’importation des fichiers CSV via l’interface Dolibarr.  

---

### **Séance n°5 - 25/10, 13h00 - 16h00**  
**Travail effectué :**  
- **Configuration avancée des modules :**  
  - Alioun a ajusté les paramètres des modules, notamment les limites de crédits pour les clients.  

- **Importation des fichiers CSV via l’interface :**  
  - Mohammed a importé les fichiers `clients.csv` et `produits.csv` via l'interface praphique.  
  - Des erreurs de formatage ont été corrigées pour assurer un import réussi.  

**À faire pour la prochaine séance :**  
- Automatiser la configuration des modules avec Docker Compose.  
- Rechercher une solution pour automatiser l’importation des fichiers CSV.  

---

### **Séance n°6 - 04/11, 14h30 - 17h30**  
**Travail effectué :**  
- **Automatisation de la configuration avec Docker Compose :**  
  - alioun a modifié `docker-compose.yml` pour préconfigurer Dolibarr avec les modules activés par défaut.  

- **Résolution du problème de persistance de configuration :**  
  - recherche d'une solution pour que dolibarr ne garde pas la premiere configuration  

**À faire pour la prochaine séance :**  
- Finaliser l’automatisation de l’importation des données pour un démarrage complet.  

---

### **Séance n°7 - 05/11, 14h30 - 17h30**  
**Travail effectué :**  
- **Recherche et résolution du problème de persistance de configuration :**  
  - on a supprimé les volumes Docker pour garantir que la configuration de Dolibarr soit bien réinitialisée après chaque suppression de conteneur.  

**À faire pour la prochaine séance :**  
- Continuer à tester l’importation des fichiers CSV de manière automatisée.  

---

### **Séance n°8 - 06/11, 13h00 - 16h00**  
**Travail effectué :**  
- **Automatisation de l’installation et configuration initiale :**  
  - Mohammed a configuré Docker Compose avec un fichier PHP pour préconfigurer Dolibarr (activation des modules et création d’un administrateur).  

- **Script d’importation automatique des fichiers CSV :**  
  - Mohammed a développé un script pour automatiser l’importation des fichiers CSV dans Dolibarr.  

**À faire pour la prochaine séance :**  
- Tester à nouveau le script d’importation des fichiers CSV.  
- Vérifier la persistance des données après redémarrage.  

---

### **Séance n°9 - 07/11, 14h30 - 17h30**  
**Travail effectué :**  
- **Tests de l’importation automatique des fichiers CSV :**  
  - on a tenté d'automatiser l'importation des fichiers CSV, mais le script d'importation ne fonctionne pas comme prévu. Le processus échoue lors de l'importation des données dans les modules "Clients" et "Produits". 
**À faire pour la prochaine séance :**  
  - modifier script pour automatiser l’importation des fichiers CSV dans Dolibarr.  

