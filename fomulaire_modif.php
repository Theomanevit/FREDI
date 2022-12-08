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
    <title>modifier une ligne de frais</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>modifier une ligne de frais</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    <p>Type de déplacement <br /><input name="id_motif" id="id_motif" type="text" value="<?php echo $id_motif ?>" required/></p>
    <p>Trajet <br /><input name="lib_deplace" id="lib_deplace" type="text" value="<?php echo $lib_deplace ?>" required/></p>
    <p>Date du deplacement<br /><input name="date_deplace" id="date_deplace" type="date" value="<?php echo $date_deplace ?>" required/></p>
    <p>Frais de péage<br /><input name="frais_peage" id="frais_peage" type="text" value="<?php echo $frais_peage ?>" required/></p>
    <p>Frais de repas<br /><input name="frais_repas" id="frais_repas" type="text" value="<?php echo $frais_repas ?>" required/></p>
    <p>Frais d'hebergement<br /><input name="frais_heber" id="frais_heber" type="text" value="<?php echo $frais_heber ?>" required/></p>
    <p>Nombre de kilomètres<br /><input name="nb_km" id="nb_km" type="text" value="<?php echo $nb_km ?>" required/></p>
    <div><input name="id_nfrais" id="id_nfrais" type="hidden" value="<?php echo $id_nfrais; ?>" /></div>
    <div><input name="id_lfrais" id="id_lfrais" type="hidden" value="<?php echo $id_lfrais; ?>" /></div>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
</form>
<p><a href="ligne_notes.php">liste des lignes de frais</a></p>        
</body>
</html>