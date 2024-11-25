# Journal de suivi de projet : Installation d'un ERP/CRM (Dolibarr)

**Chef de projet** : HENNACH MOHAMMED  
**Équipe** : ALIOUN THIAW, FARHANE ABDESSAMAD

---

## Séance n°1 - 16/10, 8h30 - 11h30
### Travail effectué :
- **Définition des rôles et répartition des tâches** :
  - **Chef de projet (Mohammed)** : Coordination générale du projet et gestion des délais.
  - **Responsable des bases de données (Alioun)** : Configuration, choix et suivi des bases de données (MariaDB).
  - **Responsable documentation technique (Abdessamad)** : Création et gestion de la documentation technique, incluant la configuration des modules.
  
- **Exploration documentaire sur Dolibarr** :
  - Mohammed et Alioun ont exploré les différentes options d'installation de Dolibarr (Docker, packages Linux, fichier source, et VM).
  - Alioun a proposé l'utilisation de Docker pour sa flexibilité et la simplicité de déploiement.
  - Mohammed a validé la version 14.0.3 de Dolibarr, qui est stable et adaptée pour le projet.
  - Abdessamad a commencé l'exploration des modules principaux nécessaires pour l'ERP (clients, contact, etc.).

### À faire pour la prochaine séance :
- **Alioun** : Approfondir la documentation sur les bases de données compatibles avec Docker.
- **Abdessamad** : Rechercher les modules spécifiques à activer pour l'usage de l'ERP.
- **Mohammed** : Préparer un premier test d'installation de Dolibarr avec Docker.

---

## Séance n°2 - 16/10, 13h00 - 16h00
### Travail effectué :
- **Choix des modules à activer** :
  - Abdessamad a sélectionné les modules essentiels à installer dans Dolibarr, à savoir : Clients/import, export/Services, et Contact.
  - Documentation des fonctionnalités et configurations de chaque module.
  
- **Préparation de l’environnement Docker** :
  - Alioun a testé plusieurs images Docker pour Dolibarr et a choisi `dolibarr/dolibarr:14.0.3`.
  - Mohammed a validé cette image pour sa stabilité et sa compatibilité avec la version choisie.

- **Génération des fichiers CSV de test** :
  - Mohammed a généré des fichiers CSV (employes.csv et clients.csv) pour simuler les premières données à importer dans Dolibarr lors des prochaines séances.

### À faire pour la prochaine séance :
- **Alioun** : Créer un fichier `docker-compose.yml` pour automatiser l'installation de Dolibarr et MariaDB.
- **Abdessamad** : Documenter la configuration des modules dans Dolibarr.
- **Mohammed** : Vérifier l'intégration des fichiers CSV dans Dolibarr.

---

## Séance n°3 - 17/10, 14h30 - 17h30
### Travail effectué :
- **Installation de Dolibarr et MariaDB via Docker** :
  - Alioun a créé le fichier `docker-compose.yml` pour déployer Dolibarr et MariaDB dans des conteneurs Docker.
  - Abdessamad a accompagné Alioun dans la configuration des variables d’environnement pour MariaDB et Dolibarr.

- **Automatisation de l’installation initiale** :
  - Abdessamad a rédigé un script `install.sh` pour démarrer les conteneurs avec les paramètres nécessaires et configurer Dolibarr automatiquement.

- **Tests de l'image Docker** :
  - Mohammed a testé l'image `dolibarr/dolibarr:14.0.3` et a trouvé que l’image `tuxgasy/dolibarr` est plus stable.
  - Certains ajustements de configuration des modules ont été nécessaires.

### À faire pour la prochaine séance :
- **Alioun** : Configurer les modules de base dans Dolibarr via l'interface.
- **Abdessamad** : Tester l'importation des fichiers CSV et vérifier la persistance des données dans MariaDB.
- **Mohammed** : Valider la configuration des conteneurs Docker et effectuer un premier test d'importation.

---

## Séance n°4 - 24/10, 14h30 - 17h30
### Travail effectué :
- **Prise en main de l'interface Dolibarr et activation des modules** :
  - Alioun a activé les modules Clients/Prospects, Contact, Import, et Tiers dans Dolibarr via l'interface graphique.
  - Des ajustements ont été réalisés pour préparer ces modules à l'importation des données.

- **Enrichissement des fichiers CSV** :
  - Mohammed a enrichi les fichiers `employes.csv` et `clients.csv` en ajoutant des données réalistes (noms, adresses, contacts) avec l'aide de ChatGPT, afin de tester des cas d'importation plus proches de la réalité.

- **Documentation de la configuration des modules** :
  - Abdessamad a documenté les paramètres de configuration de chaque module activé, y compris les options de gestion des clients et des produits.

### À faire pour la prochaine séance :
- **Alioun** : Tester l’importation des fichiers CSV dans Dolibarr.
- **Abdessamad** : Finaliser la documentation de l'intégration des modules dans Dolibarr.
- **Mohammed** : Corriger les erreurs potentielles d’importation liées au format des fichiers CSV.

---

## Séance n°5 - 25/10, 13h00 - 16h00
### Travail effectué :
- **Configuration avancée des modules** :
  - Alioun a ajusté les paramètres des modules, comme la configuration des limites de crédit pour les clients dans le module Clients/Prospects, et testé la gestion des stocks dans le module Produits/Services.

- **Importation des fichiers CSV** :
  - Mohammed a procédé à l'importation des fichiers `clients.csv` et `produits.csv` via l'interface graphique de Dolibarr.
  - Abdessamad a vérifié les logs d'importation et corrigé plusieurs erreurs de formatage liées à l'encodage des données.

### À faire pour la prochaine séance :
- **Alioun** : Automatiser la configuration des modules via Docker Compose pour une gestion plus souple.
- **Abdessamad** : Rechercher une méthode d'automatisation pour l'importation récurrente des fichiers CSV.
- **Mohammed** : Tester un import en masse pour valider le processus avec un volume de données plus important.

---

## Séance n°6 - 04/11, 14h30 - 17h30
### Travail effectué :
- **Automatisation de la configuration avec Docker Compose** :
  - Alioun a modifié le fichier `docker-compose.yml` pour intégrer des options permettant de préconfigurer Dolibarr avec les modules activés par défaut à chaque redémarrage des conteneurs Docker.

- **Résolution des problèmes de persistance de la configuration** :
  - Mohammed a trouvé une solution pour garantir la persistance des configurations de modules après chaque redémarrage des conteneurs. La solution implique l'utilisation de volumes Docker pour stocker les données et configurations de manière persistante.

### À faire pour la prochaine séance :
- **Alioun** : Finaliser l’automatisation de l'importation des données.
- **Abdessamad** : Tester l'importation automatique avec différents fichiers CSV.
- **Mohammed** : Vérifier la bonne persistance des configurations après chaque redémarrage des conteneurs.

---

## Séance n°7 - 05/11, 14h30 - 17h30
### Travail effectué :
- **Tests de la persistance des configurations** :
  - Alioun a effectué des tests pour vérifier que la configuration de Dolibarr est correctement réinitialisée après chaque redémarrage des conteneurs Docker. Un problème a été résolu en supprimant les volumes après chaque `docker-compose down`.

- **Test de l'importation de fichiers CSV** :
  - Abdessamad a effectué plusieurs tests d'importation de fichiers CSV pour s'assurer que le processus fonctionne correctement dans l'environnement Docker.
  - Des ajustements ont été faits sur les scripts pour assurer la bonne intégration des fichiers CSV dans les modules Clients et Produits/Services, en particulier pour les dates et numéros de téléphone.

### À faire pour la prochaine séance :
- **Alioun** : Finaliser l'intégration des volumes Docker pour garantir la persistance des configurations et données.
- **Abdessamad** : Tester l’importation automatique des fichiers CSV à plus grande échelle pour vérifier la robustesse du processus.
- **Mohammed** : Réaliser un test complet du système avec l'importation de fichiers CSV pour valider les scénarios de déploiement en production.

---

## Séance n°8 - 06/11, 13h00 - 16h00
### Travail effectué :
- **Automatisation de l’installation et configuration de Dolibarr via Docker** :
  - Mohammed a automatisé l'installation et la configuration initiale de Dolibarr avec un script PHP qui s’exécute au démarrage du conteneur. Ce script configure les modules de base (import-export, contacts, tiers) et crée un administrateur par défaut pour un accès rapide.

- **Automatisation de l'importation des fichiers CSV** :
  - Mohammed a créé un scriptqui automatise l'importation des fichiers CSV dans Dolibarr. Ce script prend en charge l'importation de données pour les modules Clients et Produits/Services.

- **Tests de performance et de fiabilité** :
  - Abdessamad a effectué des tests de performance en important un grand volume de données (1000 clients et 500 produits) pour vérifier la réactivité de l'interface et la gestion des données dans Dolibarr.
  - Quelques ajustements ont été nécessaires pour optimiser les performances du système lors de l'importation de gros volumes de données.

### À faire pour la prochaine séance :
- **Alioun** : Réaliser des tests sur l'environnement de production pour valider les configurations finales.
- **Abdessamad** : Tester l'intégration continue de nouveaux fichiers CSV à partir d'une source externe (par exemple, un FTP ou une API).
- **Mohammed** : Finaliser la documentation sur l'automatisation de l'installation et de l'importation.

---

## Séance n°9 - 07/11, 14h30 - 17h30
### Travail effectué :
- **Test en production de l’environnement Docker** :
  - Alioun a déployé Dolibarr en production sur un serveur dédié avec les configurations finalisées dans les précédentes séances. La configuration des volumes et des conteneurs a été validée.
  - Des tests ont été effectués pour vérifier la stabilité du serveur et l'intégrité des données après plusieurs redémarrages des conteneurs.

- **Tests d’importation continue** :
  - Abdessamad a mis en place un processus d'importation continue en configurant un serveur FTP pour télécharger automatiquement de nouveaux fichiers CSV dans Dolibarr. Un script a été créé pour l'importation régulière de nouveaux clients et produits à partir de ces fichiers.
  
- **Formation de l’équipe sur l’utilisation de Dolibarr** :
  - Mohammed a préparé une session de formation pour l’équipe afin de les familiariser avec l’interface de Dolibarr, les modules activés et le processus d’importation de données.

### À faire pour la prochaine séance :
- **Alioun** : Vérifier les logs pour détecter d’éventuelles erreurs sur l'importation continue.
- **Abdessamad** : Effectuer des tests supplémentaires avec des fichiers CSV de tailles variées pour valider la robustesse du processus.
- **Mohammed** : Organiser une session de formation pour l’équipe sur la gestion des utilisateurs et des accès dans Dolibarr.

---

## Séance n°10 - 10/11, 14h30 - 17h30
### Travail effectué :
- **Amélioration de l'importation continue** :
  - Abdessamad a amélioré le script d’importation automatique en y intégrant des vérifications de doublons pour éviter d'ajouter les mêmes données plusieurs fois.
  - Le processus d'importation a été testé sur un fichier CSV de 2000 entrées sans erreurs majeures.

- **Optimisation des performances** :
  - Alioun a réalisé des ajustements sur les configurations Docker pour limiter les ralentissements, notamment en réorganisant les volumes de stockage et en optimisant les ressources CPU/Memory allouées au conteneur MariaDB.

- **Formation interne et documentation** :
  - Mohammed a mis à jour la documentation technique pour inclure des informations sur l'importation de données, l'optimisation des performances et la gestion des modules dans Dolibarr.

### À faire pour la prochaine séance :
- **Alioun** : Réaliser des tests supplémentaires sur l'importation continue pour des cas de figures complexes.
- **Abdessamad** : Mettre en place une procédure de sauvegarde automatique des données importées.
- **Mohammed** : Préparer un guide de déploiement pour une installation en production.

---

## Séance n°11 - 12/11, 13h00 - 16h00
### Travail effectué :
- **Mise en place d’une procédure de sauvegarde automatique** :
  - Abdessamad a créé un script de sauvegarde automatique des bases de données MariaDB, exécuté tous les jours à 2h00 du matin. Cette sauvegarde est stockée dans un volume Docker pour garantir qu'elle persiste entre les redémarrages.

- **Tests de restauration de la base de données** :
  - Mohammed a testé la procédure de restauration de la base de données après avoir simulé une panne du conteneur. La restauration a été réussie sans perte de données.

- **Finalisation de la documentation de déploiement** :
  - Mohammed a rédigé un guide complet de déploiement de Dolibarr en production, incluant les étapes d'installation de Docker, la configuration des modules, l'importation des données, et la gestion des sauvegardes.

### À faire pour la prochaine séance :
- **Alioun** : Tester la sauvegarde et restauration dans un environnement de production pour valider la fiabilité de la procédure.
- **Abdessamad** : Créer des scripts de nettoyage pour les anciens fichiers CSV importés.
- **Mohammed** : Réaliser un test de montée en charge pour vérifier la capacité du système à gérer une plus grande volumétrie de données.

---

## Séance n°12 - 14/11, 14h30 - 17h30
### Travail effectué :
- **Tests de montée en charge** :
  - Mohammed a réalisé des tests de montée en charge en important des volumes plus importants de données (5000 clients, 10000 produits). Le système a bien réagi, mais quelques ralentissements ont été observés lors de l'importation.
  - Alioun a ajusté les paramètres de mémoire et de CPU pour améliorer les performances.

- **Automatisation de la gestion des fichiers CSV** :
  - Abdessamad a automatisé le nettoyage des anciens fichiers CSV après leur importation pour éviter l’encombrement du répertoire d’importation.

- **Amélioration de la gestion des utilisateurs** :
  - Mohammed a finalisé la gestion des utilisateurs dans Dolibarr, en configurant des rôles avec des permissions spécifiques pour les équipes.

### À faire pour la prochaine séance :
- **Alioun** : Vérifier la gestion des logs d'importation pour identifier les erreurs persistantes.
- **Abdessamad** : Tester le nettoyage automatisé et les performances d’importation.
- **Mohammed** : Organiser la mise en production définitive.

---

## Séance n°13 - 15/11, 14h30 - 17h30
### Travail effectué :
- **Mise en production définitive** :
  - Alioun a supervisé le déploiement final de Dolibarr, avec les configurations validées et les modules en place.
  - Abdessamad a vérifié l’intégrité des données importées et la bonne configuration des sauvegardes automatiques et de la restauration.

- **Suivi et validation du système** :
  - Mohammed a effectué un dernier test complet de l’importation et l'exportation de données et de la gestion des utilisateurs.
  - Des tests de performance ont montré que le système est stable et fonctionne correctement pour les utilisateurs en production.

---

**Fin du projet**.
