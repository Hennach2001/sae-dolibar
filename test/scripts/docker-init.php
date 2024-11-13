#!/usr/bin/env php
<?php
require_once '../htdocs/master.inc.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';

$mods = ['User', 'Fournisseur', 'Societe', 'Propale', 'Commande'];
foreach ($mods as $mod) {
        activateModule('mod'.$mod);
}
?>