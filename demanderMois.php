<?php
require_once 'include/class.pdogsb.inc.php';

$pdo = PdoGsb::getPdoGsb();

if (!empty($_GET['idUser'])) {
    $idUser = $_GET['idUser'];
    $mois = $pdo->getLesMoisDisponibles($idUser);

    $listMois = array();

    foreach ($mois as $item) {
        $listMois[] = $item;
    }

    exit(json_encode($listMois));
} else {
    $_REQUEST['action'] = 'demandeConnexion';
}