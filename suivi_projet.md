# Journal de suivi de projet : Installation d'un ERP/CRM (Dolibarr)

## Chef de projet : HENNACH MOHAMMED  
## Équipe : ALIOUN THIAW, FARHANE ABDESSAMAD  

---

### Séance n°1 - 16/10, 8h30 - 11h30  
**Travail effectué :**

- **Définition des rôles et répartition des tâches :**  
  - **Chef de projet (Mohammed)** : Prise en charge de la coordination générale du projet et de la gestion des délais.  
  - **Responsable des bases de données (Alioun)** : Chargé de la configuration, du choix et du suivi des bases de données (MariaDB).  
  - **Responsable documentation technique (Abdessamad)** : Création et gestion de la documentation technique du projet, y compris la configuration des modules.

- **Exploration documentaire sur Dolibarr :**  
  - **Mohammed** et **Alioun** ont étudié les options d'installation de Dolibarr (Docker, packages Linux, fichier source, et VM).  
  - **Alioun** a proposé l'utilisation de **Docker** en raison de sa flexibilité et de la simplicité de déploiement.  
  - **Mohammed** a validé le choix de la version **14.0.3** de Dolibarr, stable et adaptée pour le projet.  
  - **Abdessamad** a commencé à explorer les modules principaux nécessaires pour l’ERP (clients, facturation, etc.).

**À faire pour la prochaine séance :**  
- **Alioun** : Approfondir la documentation sur les bases de données compatibles avec Docker.  
- **Abdessamad** : Rechercher les modules spécifiques à activer pour l'usage de l'ERP.  
- **Mohammed** : Préparer un premier test d'installation de Dolibarr avec Docker.

---

### Séance n°2 - 16/10, 13h00 - 16h00  
**Travail effectué :**

- **Choix des modules à activer :**  
  - **Abdessamad** a passé en revue les modules essentiels à installer dans Dolibarr pour répondre aux besoins du projet.  
  - Modules sélectionnés : **Clients/Prospects**, **Produits/Services**, **Contact**, **Facturation**.  
  - Documentation des fonctionnalités de chaque module et de leurs configurations de base.

- **Préparation de l’environnement Docker :**  
  - **Alioun** a testé plusieurs images Docker pour Dolibarr et a choisi **dolibarr/dolibarr:14.0.3**.  
  - **Mohammed** a validé cette image pour sa stabilité et son support de la version choisie.

- **Génération des fichiers CSV de test :**  
  - **Mohammed** a généré des fichiers CSV (`employes.csv` et `clients.csv`) pour simuler les premières données à importer dans l'ERP. Ces fichiers servent à tester l'importation dans Dolibarr lors des prochaines séances.

**À faire pour la prochaine séance :**  
- **Alioun** : Créer un fichier **`docker-compose.yml`** pour automatiser l'installation de Dolibarr et MariaDB.  
- **Abdessamad** : Documenter la configuration des modules dans Dolibarr.  
- **Mohammed** : Vérifier l'intégration des fichiers CSV dans Dolibarr.

---

### Séance n°3 - 17/10, 14h30 - 17h30  
**Travail effectué :**

- **Installation de Dolibarr et MariaDB via Docker :**  
  - **Alioun** a créé le fichier **`docker-compose.yml`**, permettant de déployer Dolibarr et MariaDB dans des conteneurs Docker.  
  - **Abdessamad** a accompagné Alioun dans la configuration des variables d’environnement pour MariaDB et Dolibarr.

- **Automatisation de l’installation initiale :**  
  - **Abdessamad** a rédigé un script **`install.sh`** permettant de démarrer les conteneurs avec les paramètres nécessaires, et de configurer automatiquement Dolibarr dès l'exécution du script.

- **Tests de l'image Docker :**  
  - **Mohammed** a testé l'image **dolibarr/dolibarr:14.0.3** et a validé que l'ERP se déployait correctement.  
  - Quelques tests ont montré que certaines configurations de modules devaient être ajustées.

**À faire pour la prochaine séance :**  
- **Alioun** : Configurer les modules de base dans Dolibarr via l'interface.  
- **Abdessamad** : Tester l'importation des fichiers CSV et vérifier la persistance des données dans MariaDB.  
- **Mohammed** : Valider la configuration des conteneurs Docker et effectuer un premier test d'importation.

---

### Séance n°4 - 24/10, 14h30 - 17h30  
**Travail effectué :**

- **Prise en main de l'interface Dolibarr et activation des modules :**  
  - **Alioun** a activé les modules **Clients/Prospects**, **Contact**, **Import**, et **Tiers** dans Dolibarr via l'interface graphique.  
  - Des ajustements ont été réalisés pour que ces modules soient prêts à l'importation des données.

- **Enrichissement des fichiers CSV :**  
  - **Mohammed** a enrichi les fichiers **`employes.csv`** et **`clients.csv`** en ajoutant des données réalistes (noms, adresses, contacts), afin de tester des cas d'importation plus proches d'une situation réelle.

- **Documentation de la configuration des modules :**  
  - **Abdessamad** a documenté les paramètres de configuration de chaque module activé, y compris les options de gestion des clients et des produits.

**À faire pour la prochaine séance :**  
- **Alioun** : Tester l’importation des fichiers CSV dans Dolibarr.  
- **Abdessamad** : Finaliser la documentation de l'intégration des modules dans Dolibarr.  
- **Mohammed** : Corriger les erreurs potentielles d’importation liées au format des fichiers CSV.

---

### Séance n°5 - 25/10, 13h00 - 16h00  
**Travail effectué :**

- **Configuration avancée des modules :**  
  - **Alioun** a ajusté les paramètres des modules, par exemple en configurant les limites de crédit pour les clients dans le module **Clients/Prospects** et en testant la gestion des stocks dans **Produits/Services**.

- **Importation des fichiers CSV :**  
  - **Mohammed** a procédé à l'importation des fichiers **`clients.csv`** et **`produits.csv`** via l'interface graphique de Dolibarr.  
  - **Abdessamad** a vérifié les logs d'importation et corrigé plusieurs erreurs de formatage liées à l'encodage des données.

**À faire pour la prochaine séance :**  
- **Alioun** : Automatiser la configuration des modules via Docker Compose pour une gestion plus souple.  
- **Abdessamad** : Rechercher une méthode d'automatisation pour l'importation récurrente des fichiers CSV.  
- **Mohammed** : Tester un import en masse pour valider le processus avec un volume de données plus important.

---

### Séance n°6 - 04/11, 14h30 - 17h30  
**Travail effectué :**

- **Automatisation de la configuration avec Docker Compose :**  
  - **Alioun** a modifié le fichier **`docker-compose.yml`** pour intégrer des options permettant de préconfigurer Dolibarr avec les modules activés par défaut à chaque redémarrage des conteneurs Docker.  
  - Cela permet de ne pas avoir à configurer manuellement Dolibarr après chaque redémarrage.

- **Résolution des problèmes de persistance de la configuration :**  
  - **Mohammed** a cherché une solution pour garantir que les configurations des modules sont bien conservées après chaque redémarrage des conteneurs.  
  - La solution trouvée consiste à utiliser des volumes Docker pour stocker les données et les configurations de manière persistante.

**À faire pour la prochaine séance :**  
- **Alioun** : Finaliser l’automatisation de l'importation des données.  
- **Abdessamad** : Tester l'importation automatique avec différents fichiers CSV.  
- **Mohammed** : Vérifier la bonne persistance des configurations après chaque redémarrage des conteneurs.

---

### Séance n°7 - 05/11, 14h30 - 17h30  
**Travail effectué :**

- **Tests de la persistance des configurations :**  
  - **Alioun** a effectué des tests pour vérifier que la configuration de Dolibarr est correctement réinitialisée après chaque redémarrage des conteneurs Docker.  
  - Lors des tests, on a trouver que dolibarr garde toujour sa premiere configuration 
  - Le problème a été résolu avec la suprission des volumes apres chaque docker-compose down
- **Test de l'importation de fichiers CSV :**  
  - **Abdessamad** a effectué plusieurs tests d'importation de fichiers CSV pour s'assurer que le processus fonctionne correctement dans l'environnement Docker.  
  - Des ajustements ont été faits sur les scripts pour assurer la bonne intégration des fichiers CSV dans les modules de **Clients** et **Produits/Services**.  
  - Un problème de gestion des colonnes a été corrigé, en particulier pour les dates et les numéros de téléphone.

**À faire pour la prochaine séance :**  
- **Alioun** : Finaliser l'intégration des volumes Docker pour garantir la persistance des configurations et données.  
- **Abdessamad** : Tester l’importation automatique des fichiers CSV à plus grande échelle pour vérifier la robustesse du processus.  
- **Mohammed** : Réaliser un test complet du système avec l'importation de fichiers CSV pour valider les scénarios de déploiement en production.

---

### Séance n°8 - 06/11, 13h00 - 16h00  
**Travail effectué :**

- **Automatisation de l’installation et configuration de Dolibarr via Docker :**  
  - **Mohammed** a automatisé l'installation et la configuration initiale de Dolibarr avec un fichier PHP qui s’exécute au démarrage du conteneur.  
  - Ce script configure les modules de base (**Clients/Prospects**, **Produits/Services**, **Facturation**) et crée un administrateur par défaut pour un accès rapide.

- **Automatisation de l'importation des fichiers CSV :**  
  - **Mohammed** a créé un script d'importation automatique des fichiers CSV, qui permet de charger les fichiers sans nécessiter d'intervention manuelle.  
  - Le script a été testé avec succès, permettant de charger des données dans les modules **Clients/Prospects** et **Produits** en quelques minutes.

- **Test de l’importation des fichiers CSV :**  
  - **Abdessamad** a testé le script d’importation en utilisant des fichiers CSV de test et a validé que les données étaient correctement insérées dans Dolibarr, sans erreurs de formatage ou de données manquantes.

**À faire pour la prochaine séance :**  
- **Alioun** : Tester la persistance des configurations après plusieurs redémarrages des conteneurs.  
- **Abdessamad** : Automatiser l’importation des fichiers CSV pour d'autres modules (ex. **Facturation**).  
- **Mohammed** : Préparer un plan de tests pour simuler un déploiement complet en pré-production.

---

### Séance n°9 - 07/11, 14h30 - 17h30  
**Travail effectué :**

- **Tests de l'importation automatique des fichiers CSV :**  
  - **Alioun** a effectué des tests d'importation avec des fichiers CSV plus volumineux pour vérifier la performance et la stabilité du processus d'importation.  
  - Un problème a été identifié avec le format de certaines dates dans les fichiers CSV, ce qui a provoqué des erreurs lors de l'importation. **Mohammed** a corrigé ce problème en ajustant le format des dates dans les fichiers de test.

- **Tests d’intégration avec Docker Compose :**  
  - **Abdessamad** a validé l'intégration des scripts d'importation automatique dans l'environnement Docker Compose.  
  - Des ajustements ont été apportés pour que l'importation des fichiers CSV fonctionne correctement à chaque redémarrage des conteneurs.

**À faire pour la prochaine séance :**  
- **Alioun** : Continuer à tester l'importation avec des fichiers plus volumineux.  
- **Abdessamad** : Finaliser le script d’importation pour inclure des modules supplémentaires.  
- **Mohammed** : Vérifier que tous les modules peuvent être intégrés et testés avec des fichiers CSV.

---

### Séance n°10 - 13/11, 08h30 - 11h30  
**Travail effectué :**

- **Tests de l'importation automatique des fichiers CSV :**  
  - **Mohammed** a testé un nouveau script PHP pour l'importation des fichiers CSV dans Dolibarr.  
  - Le script fonctionne correctement et importe les données sans erreurs majeures.  
  - **Abdessamad** a validé l'intégration des données dans les modules **Clients/Prospects** et **Employés**, et a assuré qu’aucune donnée n'était perdue durant l’import.

- **Tests d’exportation automatique des données CSV :**  
  - **Abdessamad** a mis au point un script **`export_employees.php`** pour automatiser l'exportation des données des employés sous forme de fichiers CSV.  
  - Le premier test de ce script a échoué en raison d’un problème de permissions dans le conteneur Docker. **Alioun** a modifié les permissions des fichiers et a testé à nouveau, avec succès.

**À faire pour la prochaine séance :**  
- **Alioun** : Vérifier que les permissions du conteneur Docker permettent une exécution fluide des scripts d’import/export.  
- **Abdessamad** : Tester le script d’exportation pour s’assurer qu’il fonctionne de manière stable.  
- **Mohammed** : Préparer une solution pour automatiser l'exportation des fichiers CSV directement depuis le terminal.

---

### Séance n°11 - 13/11, 13h00 - 16h00  
**Travail effectué :**

- **Amélioration des scripts d'importation et d'exportation :**  
  - **Abdessamad** a amélioré le script d’exportation **`export_employees.php`** en optimisant la gestion des erreurs et en assurant un formatage correct des fichiers CSV.  
  - Des tests ont été effectués et ont montré que le script exporte désormais les données correctement.

- **Création de scripts Shell pour automatiser l'import/export via terminal :**  
  - **Mohammed** a créé deux scripts Shell (**`import_csv.sh`** et **`export_csv.sh`**) permettant d’exécuter l’importation et l’exportation des fichiers CSV directement via le terminal. Ces scripts facilitent l'intégration dans des processus automatisés sans avoir besoin d'une interface graphique.  
  - **Abdessamad** a testé ces scripts et a confirmé qu'ils fonctionnent correctement dans l'environnement Docker.  
  - Ces scripts permettent une gestion plus fluide des données dans Dolibarr, et sont maintenant utilisés pour le déploiement en production.

**À faire pour la prochaine séance :**  
- **Alioun** : Tester les scripts Shell dans l’environnement de pré-production pour vérifier leur robustesse avec des fichiers plus volumineux.  
- **Abdessamad** : Finaliser la documentation des scripts d’import/export pour une utilisation à grande échelle.  
- **Mohammed** : Vérifier que le processus d'importation et d'exportation fonctionne de manière fluide avec différents types de données et tailles de fichiers.

---
