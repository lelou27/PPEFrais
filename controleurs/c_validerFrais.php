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
    case 'ValiderMajFraisForfait':
        if (!empty($_POST)) {
            $newQuantite = trim(strip_tags($_POST['newQuantite']));
            $mois = trim(strip_tags($_POST['mois']));
            $numAnnee = trim(strip_tags($_POST['annee']));
            $idVisiteur = trim(strip_tags($_POST['idVisiteur']));
            $unIdFrais = trim(strip_tags($_POST['idFraisForfait']));
            $mois = $numAnnee . $mois;

            $pdo->majFraisForfaitQuantite($idVisiteur, $mois, $newQuantite, $unIdFrais);

            header('Location: index.php?uc=validerFrais&action=validerFrais');
        }
        break;
    case 'ValiderFicheFrais':
        if (!empty($_POST)) {
            $idVisiteur = trim(strip_tags($_POST['idVisiteur']));
            $mois = trim(strip_tags($_POST['mois']));
            $montant = trim(strip_tags($_POST['montant']));

            $pdo->validerFicheFrais($idVisiteur,$mois,'VA', $montant);
        }
        break;
}