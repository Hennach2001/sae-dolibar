<?php
// Configuration de la connexion MySQL
$mysqli = new mysqli('mariadb', 'root', 'root', 'dolibarr');

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Échec de la connexion à la base de données : " . $mysqli->connect_error);
}

// Lecture du fichier CSV
$csv_file = '/var/www/scripts/docker-init.d/employes.csv';
if (!file_exists($csv_file)) {
    die("Le fichier CSV n'existe pas : $csv_file\n");
}

$handle = fopen($csv_file, 'r');
if (!$handle) {
    die("Impossible de lire le fichier CSV.\n");
}

// Lire l'en-tête du CSV
$header = fgetcsv($handle, 0, ',');

// Identifiant du Super Admin
$fk_user_creat = 1; // ID du Super Admin

// Parcourir les lignes du fichier CSV
while (($row = fgetcsv($handle, 0, ',')) !== false) {
    $data = array_combine($header, $row);

    // Préparer les données pour l'insertion
    $lastname = $mysqli->real_escape_string($data['nom']);
    $firstname = $mysqli->real_escape_string($data['prénom']);
    $email = $mysqli->real_escape_string($data['email']);
    $phone = $mysqli->real_escape_string($data['telephone']);
    $address = $mysqli->real_escape_string($data['adresse']);
    $zip = $mysqli->real_escape_string($data['code_postal']);
    $town = $mysqli->real_escape_string($data['ville']);
    $fk_soc = 'NULL'; // Aucune société associée pour le moment

    // Insertion dans la table llx_socpeople
    $query = "
        INSERT INTO llx_socpeople (lastname, firstname, email, phone, address, zip, town, fk_soc, entity, statut, datec, fk_user_creat)
        VALUES (
            '$lastname',
            '$firstname',
            '$email',
            '$phone',
            '$address',
            '$zip',
            '$town',
            $fk_soc,
            1, -- Entité (par défaut 1)
            1, -- Statut actif
            NOW(),
            $fk_user_creat
        )
    ";

    // Exécuter la requête
    if (!$mysqli->query($query)) {
        echo "Erreur lors de l'insertion du contact : " . $mysqli->error . "\n";
    } else {
        echo "Contact ajouté : $firstname $lastname\n";
    }
}

fclose($handle);
$mysqli->close();
