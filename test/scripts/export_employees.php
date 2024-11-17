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

// Préparer la requête pour récupérer tous les utilisateurs
$query = "SELECT firstname, lastname, email, company, birthdate, address, postal_code, town, phone FROM llx_user";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Ouvrir un fichier CSV pour l'écriture
$csvFile = '/var/www/test/data/employes_export.csv';  // Chemin du fichier CSV de sortie
$csvHandle = fopen($csvFile, 'w');

if ($csvHandle === false) {
    echo "Erreur lors de l'ouverture du fichier CSV pour l'écriture.\n";
    exit;
}

// Écrire l'en-tête du CSV
$header = ['prénom', 'nom', 'email', 'societe', 'date_naissance', 'adresse', 'code_postal', 'ville', 'telephone'];
fputcsv($csvHandle, $header);

// Parcourir les utilisateurs et les écrire dans le fichier CSV
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($csvHandle, $row);
}

fclose($csvHandle);

echo "Exportation terminée. Les données ont été enregistrées dans $csvFile.\n";
?>

