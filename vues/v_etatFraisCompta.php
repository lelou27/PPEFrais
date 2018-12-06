<br><br><br>
<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> :
</h3>
<div class="encadre" style="margin-left: .5em; padding: 1em; margin-bottom: 1em;">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>


    </p>
    <?php
    if (!empty($lesFraisForfait)) {
    ?>
        <table class="listeLegere">
            <caption>Eléments forfaitisés </caption>
            <tr>
                <?php
                foreach ( $lesFraisForfait as $unFraisForfait )
                {
                    $libelle = $unFraisForfait['libelle'];
                    ?>
                    <th> <?php echo $libelle?></th>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <?php
                foreach (  $lesFraisForfait as $unFraisForfait  )
                {
                    $quantite = $unFraisForfait['quantite'];
                    ?>
                    <td class="qteForfait"><?php echo $quantite?> </td>
                    <?php
                }
                ?>
            </tr>
        </table>
    <?php
    } else
        echo '<h3>Pas de fiche de frais pour ce visiteur ce mois</h3>';

    if (!empty($lesFraisForfait) && !empty($lesFraisHorsForfait)) {
        ?>
        <table class="listeLegere">
            <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
            </caption>
            <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>
            </tr>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $date = $unFraisHorsForfait['date'];
                $libelle = $unFraisHorsForfait['libelle'];
                $montant = $unFraisHorsForfait['montant'];
                ?>
                <tr>
                    <td><?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <a href="">Valider la fiche de frais</a>
        <?php
    }
    ?>
</div>
</div>