<?php
// Fichier conf.php pour Dolibarr
$dolibarr_main_url_root = 'http://localhost';
$dolibarr_main_document_root = '/var/www/html';
$dolibarr_main_url_root_alt = '/custom';
$dolibarr_main_document_root_alt = '/var/www/html/custom';
$databasetype = 'mysqli';
$database_host = 'mariadb'; // Correspond au service MariaDB
$database_port = '3306';
$database_name = 'dolibarr';
$database_user = 'root';
$database_pass = 'root';
$database_prefix = 'llx_';  // Préfixe des tables dans Dolibarr
$dolibarr_main_db_character_set = 'utf8mb4';
