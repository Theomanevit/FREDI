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
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="css/tableau.css">
</head>

<body>
    <?php include('header.php') ?>
    <h1>supprimer une ligne de frais</h1>

    <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <form action="<?php echo $_SERVER['PHP_SELF'].'?id_nfrais='.$id_nfrais.'';?>" method="post">
                    <div class="field padding-bottom--24">
                        <label>Libellé du déplacement</label>
                        <input type="text" name="lib_deplace" id="lib_deplace" value="<?php echo $lib_deplace ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Date du deplacement</label>
                        <input type="date" name="date_deplace" id="date_deplace" value="<?php echo $date_deplace ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Frais de péage</label>
                        <input type="text" name="frais_peage" id="frais_peage" value="<?php echo $frais_peage ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Frais de repas</label>
                        <input type="text" name="frais_repas" id="frais_repas" value="<?php echo $frais_repas ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Frais d'hebergement</label>
                        <input type="text" name="frais_heber" id="frais_heber" value="<?php echo $frais_heber ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Nombre de kilomètre</label>
                        <input type="text" name="nb_km" id="nb_km" value="<?php echo $nb_km ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Motif</label>
                        <select name="id_motif" id="id_motif" value=<?php echo $id_motif ?> disabled>
                        <?php foreach($rows_motif as $motif) {
                                if($motif["id_motif"] == $id_motif) {
                                    echo "<option selected value='".$motif["id_motif"]."'>".$motif["lib_motif"]."</option>";
                                } else {
                                    echo "<option value='".$motif["id_motif"]."'>".$motif["lib_motif"]."</option>";
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <div>
                        <div><input name="id_nfrais" id="id_nfrais" type="hidden" value="<?php echo $id_nfrais; ?>" /></div>
                        <div><input name="id_adherant" id="id_adherant" type="hidden" value="<?php echo $id_adherant; ?>" /></div>
                        <div><input name="id_lfrais" id="id_lfrais" type="hidden" value="<?php echo $id_lfrais; ?>" /></div>
                    </div>
                    <div class="field padding-bottom--24">
                        <input type="submit" name="submit" value="Validée" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>