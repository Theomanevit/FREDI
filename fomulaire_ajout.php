<?php
session_start();



require('backend/CRUD_ligne_frais/ajout_ligne.php');


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ajouter une ligne de frais</title>
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="css/tableau.css">

</head>

<body>
    <?php include('header.php') ?>
    <h1>Ajouter une ligne de frais</h1>
    <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="field padding-bottom--24">
                        <label>Libellé du déplacement</label>
                        <input type="text" name="lib_deplace" id="lib_deplace" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Date du deplacement</label>
                        <input type="date" name="date_deplace" id="date_deplace" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Frais de péage</label>
                        <input type="text" name="frais_peage" id="frais_peage" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Frais de repas</label>
                        <input type="text" name="frais_repas" id="frais_repas" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Frais d'hebergement</label>
                        <input type="text" name="frais_heber" id="frais_heber" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Nombre de kilomètre</label>
                        <input type="text" name="nb_km" id="nb_km" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Motif</label>
                        <select name="id_motif" id="id_motif" required>
                            <option value="">Choisissez un motif</option>
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


    </form>
</body>

</html>