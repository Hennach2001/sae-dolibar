<?php
// Configuration de la connexion à la base de données Dolibarr
$host = 'mariadb';  // Nom du service pour MariaDB dans Docker Compose
$dbname = 'dolibarr';  // Nom de la base de données Dolibarr
$username = 'root';  // Utilisateur MySQL
$password = 'root';  // Mot de passe MySQL

// Connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données Dolibarr.\n";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

// Lire le fichier CSV
$csvFile = '/var/www/test/data/employes.csv';  // Chemin du fichier CSV dans le conteneur Docker

if (!file_exists($csvFile)) {
    echo "Le fichier CSV n'a pas été trouvé.";
    exit;
}

$csvData = array_map('str_getcsv', file($csvFile));  // Lire le fichier CSV
$header = array_shift($csvData);  // Récupérer l'en-tête du fichier CSV

// Préparer la requête d'insertion
$query = "INSERT INTO llx_user (firstname, lastname, email, company, birthdate, address, postal_code, town, phone, login) 
          VALUES (:firstname, :lastname, :email, :company, :birthdate, :address, :postal_code, :town, :phone, :login)";

$stmt = $pdo->prepare($query);

// Parcourir les lignes du CSV et insérer dans la base de données
foreach ($csvData as $row) {
    // Mapper les données du CSV aux colonnes de la table llx_user
    $data = array_combine($header, $row);

    // Vérification des données essentielles
    if (empty($data['email']) || empty($data['nom']) || empty($data['prénom'])) {
        echo "Ligne ignorée : données manquantes pour " . $data['nom'] . " " . $data['prénom'] . "\n";
        continue;  // Ignore la ligne si des données essentielles sont manquantes
    }

    // Lier les valeurs aux paramètres de la requête
    $stmt->bindParam(':firstname', $data['prénom']);
    $stmt->bindParam(':lastname', $data['nom']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':company', $data['societe']);
    $stmt->bindParam(':birthdate', $data['date_naissance']);
    $stmt->bindParam(':address', $data['adresse']);
    $stmt->bindParam(':postal_code', $data['code_postal']);
    $stmt->bindParam(':town', $data['ville']);
    $stmt->bindParam(':phone', $data['telephone']);
    $stmt->bindParam(':login', $data['email']);  // Utilisation de l'email comme login

    // Exécuter l'insertion
    try {
        if ($stmt->execute()) {
            echo "Employé " . $data['nom'] . " " . $data['prénom'] . " inséré avec succès.\n";
        } else {
            echo "Erreur lors de l'insertion de " . $data['nom'] . " " . $data['prénom'] . ".\n";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion de " . $data['nom'] . " " . $data['prénom'] . " : " . $e->getMessage() . "\n";
    }
}

echo "Importation terminée.\n";
?>

