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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>ajouter une ligne de frais</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    <p>libellé du deplacement<br /><input name="lib_deplace" id="lib_deplace" type="text" value="" required/></p>
    <p>date du deplacement<br /><input name="date_deplace" id="date_deplace" type="date" value="" required/></p>
    <p>frais de péage<br /><input name="frais_peage" id="frais_peage" type="text" value="" required/></p>
    <p>frais de repas<br /><input name="frais_repas" id="frais_repas" type="text" value="" required/></p>
    <p>frais d'hebergement<br /><input name="frais_heber" id="frais_heber" type="text" value="" required/></p>
    <p>nombre de kilomètre<br /><input name="nb_km" id="nb_km" type="text" value="" required/></p>
    <p>id motif<br /><input name="id_motif" id="id_motif" type="text" value="" required/></p>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
</form>
<p><a href="ligne_notes.php">liste des lignes de frais</a></p>        
</body>
</html>