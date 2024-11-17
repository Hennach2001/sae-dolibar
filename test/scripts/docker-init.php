#!/usr/bin/env php
<?php
require_once '../htdocs/master.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';

$mods = ['User', 'Import', 'Societe'];
foreach ($mods as $mod) {
        activateModule('mod'.$mod);
};

printf("OK\n");

if (!empty(getenv('DOLI_COMPANY_COUNTRYCODE'))) {
  require_once DOL_DOCUMENT_ROOT.'/core/lib/company.lib.php';
  require_once DOL_DOCUMENT_ROOT.'/core/class/ccountry.class.php';
  $countryCode = getenv('DOLI_COMPANY_COUNTRYCODE');
  $country = new Ccountry($db);
  $res = $country->fetch(0,$countryCode);
  if ($res > 0 ) {
    $s = $country->id.':'.$country->code.':'.$country->label;
    dolibarr_set_const($db, "MAIN_INFO_SOCIETE_COUNTRY", $s, 'chaine', 0, '', $conf->entity);
    printf('Configuring for country : '.$s."\n");
    activateModulesRequiredByCountry($country->code);
  } else {
    printf('Unable to find country '.$countryCode."\n");
  }
}

if (!empty(getenv('DOLI_COMPANY_NAME'))) {
  $compname = getenv('DOLI_COMPANY_NAME');
  dolibarr_set_const($db, "MAIN_INFO_SOCIETE_NOM", $compname, 'chaine', 0, '', $conf->entity);
}

if (!empty(getenv('DOLI_ENABLE_MODULES'))) {
  $mods = explode(',', getenv('DOLI_ENABLE_MODULES'));
  foreach ($mods as $mod) {
    printf("Activating module ".$mod." ...");
    try { 
      $res = activateModule('mod' . $mod);
      if ($res < 0) { 
        print(" FAILED. Unable to load module. Be sure to check the case\n");
      } else {
        printf(" OK\n");
      }
    } catch (Throwable $t) {
      print(" FAILED. Unable to load module. Be sure to check the case\n");
    }
  }
}

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
