<?php
session_start();



require('backend/CRUD_ligne_frais/suppr_ligne.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>supprimer une ligne de frais</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include('header.php') ?>
    <h1>supprimer une ligne de frais</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="field padding-bottom--24">
                        <label>Motif</label>
                        <select name="id_motif" id="id_motif" value=<?php echo $id_motif ?> disabled>
                            <option value="1">Réunion</option>
                            <option value="2">Compétition régionale</option>
                            <option value="3">Compétition nationale</option>
                            <option value="4">Compétition internationnale</option>
                            <option value="5">Stage</option>
                            <option value="6">Visite médicale</option>
                            <option value="7">Oxygénation</option>
                            <option value="8">Convocation</option>
                            <option value="9">Formation</option>
                        </select>
                    </div>
        <p>date du deplacement<br /><input name="date_deplace" id="date_deplace" type="date" value="<?php echo $date_deplace ?>" disabled /></p>
        <p>frais de péage<br /><input name="frais_peage" id="frais_peage" type="text" value="<?php echo $frais_peage ?>" disabled /></p>
        <p>frais de repas<br /><input name="frais_repas" id="frais_repas" type="text" value="<?php echo $frais_repas ?>" disabled /></p>
        <p>frais d'hebergement<br /><input name="frais_heber" id="frais_heber" type="text" value="<?php echo $frais_heber ?>" disabled /></p>
        <p>nombre de kilomètre<br /><input name="nb_km" id="nb_km" type="text" value="<?php echo $nb_km ?>" disabled /></p>
        <div><input name="id_nfrais" id="id_nfrais" type="hidden" value="<?php echo $id_nfrais; ?>" /></div>
        <div><input name="id_lfrais" id="id_lfrais" type="hidden" value="<?php echo $id_lfrais; ?>" /></div>
        <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
    </form>
</body>

</html>