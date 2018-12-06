<?php
if (!empty($visiteurs)) {
?>
    <form action="" method="post">
        <input type="hidden" value="<?php echo $send ?>" class="formSending">
        <select name="visiteur" style="margin: 1em;" id="visiteurs">
            <option selected hidden>Sélectionnez l'utilisateur</option>
            <?php
            foreach ($visiteurs as $visiteur) {
                $id = $visiteur['id'];
                $name = $visiteur['nom'];
                $surname = $visiteur['prenom'];

                if (!empty($idVisiteur)) {
                    echo '<option value="'.$id.'" ' . ($id == $idVisiteur ? 'selected' : '') . '>'.$surname.' '.$name.'</option>';
                } else {
                    echo '<option value="'.$id.'">'.$surname.' '.$name.'</option>';
                }
            }
            ?>
        </select>

        <label class="lstMois" for="lstMois" accesskey="n">Mois : </label>
        <select id="lstMois" name="lstMois">
            <?php
            if (!empty($listMois)) {
                foreach ($listMois as $moisDispo) {
                    $leMois = $moisDispo['mois'];
                    $year = $moisDispo['numAnnee'];
                    $month = $moisDispo['numMois'];
                    if ($mois == $leMois)
                        echo "<option value='$leMois' selected>$month/$year</option>";
                    else
                        echo "<option value='$leMois'>$month/$year</option>";
                }
            }
            ?>
        </select>

        <input type="submit" value="Voir la fiche" class="send">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/selectVisitor.js"></script>
<?php
} else {
    echo 'Pas de visiteurs à afficher';
}