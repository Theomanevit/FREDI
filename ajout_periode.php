<?php

require('backend/connectionBdd.php');
// Liste des periodes
$annee_fisc = isset($_POST['annee_fisc']) ? $_POST['annee_fisc'] : '';
$isactive_fisc = isset($_POST['isactive_fisc']) ? $_POST['isactive_fisc'] : '';
$montant_fisc = isset($_POST['montant_fisc']) ? $_POST['montant_fisc'] : '';
$submit = isset($_POST['submit']);

// Ajout dans la base
if ($submit) {
    $sql="insert into periodefiscale (annee_fisc, isactive_fisc, montant_fisc) values (:annee_fisc,:isactive_fisc,:montant_fisc)";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":annee_fisc"=>$annee_fisc,":isactive_fisc"=>$isactive_fisc,":montant_fisc"=>$montant_fisc));
        $nb = $sth->rowcount();
      } catch (PDOException $e) {
        die( "<p>Erreur lors de la requête SQL : " . $e->getMessmontant_fisc() . "</p>");
    }
    $message="$nb periode(s) créée(s)";
} else {
  $message="Veuillez saisir une periode fiscale SVP";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ajouter une periode fiscale</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>ajouter une periode fiscale</h1>
<?php echo $message; ?></p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    <p>Année fiscale<br /><input name="annee_fisc" id="annee_fisc" type="text" value="" required/></p>
    <p>active<br /><input name="isactive_fisc" id="isactive_fisc" type="checkbox" value="1"/></p>
    <p>montant fiscale<br /><input name="montant_fisc" id="montant_fisc" type="text" value="" required/></p>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
</form>
<p>Liste des <a href="gerer_periode.php">periodes</a></p>        
</body>
</html>