<?php

if (empty($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];

switch ($action) {
    case 'validerFrais':
        $visiteurs = $pdo->getAllVisitors();
        $send = 0;

        if (!empty($_POST)) {
            $errors = array();
            $send = 1;

            $idVisiteur = trim(strip_tags($_POST['visiteur']));
            $mois = trim(strip_tags($_POST['lstMois']));

            $numAnnee =substr( $mois,0,4);
            $numMois =substr( $mois,4,2);

            $moisDispos = $pdo->getLesMoisDisponibles($idVisiteur);
            $listMois = array();

            foreach ($moisDispos as $item) {
                $listMois[] = $item;
            }

            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);
            $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$mois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$mois);

            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif =  $lesInfosFicheFrais['dateModif'];
            $dateModif =  dateAnglaisVersFrancais($dateModif);

            include("vues/v_sommaire.php");
            include("vues/v_listeVisiteursMois.php");
            include "vues/v_etatFraisCompta.php";
        }

        if (empty($_POST)) {
            include("vues/v_sommaire.php");
            include("vues/v_listeVisiteursMois.php");
        }

        break;
}