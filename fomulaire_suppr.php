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
    <title>supprimer une ligne de frais</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>supprimer une ligne de frais</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    <p>motif du deplacement<br /><input name="lib_deplace" id="lib_deplace" type="text" value="<?php echo $lib_deplace ?>" disabled/></p>
    <p>date du deplacement<br /><input name="date_deplace" id="date_deplace" type="date" value="<?php echo $date_deplace ?>" disabled/></p>
    <p>frais de péage<br /><input name="frais_peage" id="frais_peage" type="text" value="<?php echo $frais_peage ?>" disabled/></p>
    <p>frais de repas<br /><input name="frais_repas" id="frais_repas" type="text" value="<?php echo $frais_repas ?>" disabled/></p>
    <p>frais d'hebergement<br /><input name="frais_heber" id="frais_heber" type="text" value="<?php echo $frais_heber ?>" disabled/></p>
    <p>nombre de kilomètre<br /><input name="nb_km" id="nb_km" type="text" value="<?php echo $producers ?>" disabled/></p>
    <p>total des frais<br /><input name="total_lfrais" id="total_lfrais" type="text" value="<?php echo $total_lfrais ?>" disabled/></p>
    <div><input name="id_lfrais" id="id_lfrais" type="hidden" value="<?php echo $id_lfrais; ?>" /></div>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
</form>
<p><a href="ligne_notes.php">liste des lignes de frais</a></p>        
</body>
</html>