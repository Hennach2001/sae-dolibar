<?php
// Inclure le fichier de configuration de Dolibarr
// Le chemin d'accès dépend de votre installation Dolibarr
$dolibarr_path = '/var/www/html/htdocs'; // Chemin par défaut dans Docker
require_once($dolibarr_path . '/main.inc.php');
require_once($dolibarr_path . '/core/lib/admin.lib.php');

// Vérifier si l'utilisateur est administrateur
if (!$user->admin) {
    echo "Vous devez être administrateur pour activer les modules.";
    exit;
}

// Activer le module "Tiers"
$module_societe = 'societe';
if (!isModuleEnabled($module_societe)) {
    echo "Activation du module Tiers (societe)...\n";
    enableModule($module_societe);
    echo "Module Tiers activé avec succès.\n";
} else {
    echo "Le module Tiers est déjà activé.\n";
}

// Activer le module "Import"
$module_import = 'import';
if (!isModuleEnabled($module_import)) {
    echo "Activation du module Import...\n";
    enableModule($module_import);
    echo "Module Import activé avec succès.\n";
} else {
    echo "Le module Import est déjà activé.\n";
}

function isModuleEnabled($module)
{
    global $conf;
    return !empty($conf->modules[$module]);
}

function enableModule($module)
{
    global $db, $conf;
    
    $sql = "INSERT INTO " . MAIN_DB_PREFIX . "admin_modules (module, statut) VALUES ('$module', 1)";
    dolibarr_die($db->query($sql), $db);
}

