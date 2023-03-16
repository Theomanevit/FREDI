<?php
require('backend/connectionBdd.php');

$id_fisc = isset($_GET['id_fisc']) ? $_GET['id_fisc'] : '';
$annee_fisc = isset($_POST['annee_fisc']) ? $_POST['annee_fisc'] : '';
$isactive_fisc = isset($_POST['isactive_fisc']) ? $_POST['isactive_fisc'] : '';
$montant_fisc = isset($_POST['montant_fisc']) ? $_POST['montant_fisc'] : '';
$submit = isset($_POST['submit']);

// Ajout dans la base
if ($submit) {
    $id_fisc = $_POST['id_fisc'];
    $sql="update periodefiscale set annee_fisc=:annee_fisc, isactive_fisc=:isactive_fisc, montant_fisc=:montant_fisc where id_fisc=:id_fisc";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":annee_fisc"=>$annee_fisc,":isactive_fisc"=>$isactive_fisc,":montant_fisc"=>$montant_fisc, ":id_fisc"=>$id_fisc));
        $nb = $sth->rowcount();
      } catch (PDOException $e) {
        die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    $message="$nb periode modifié";
} else {
    $sql = "select * from periodefiscale where id_fisc=:id_fisc";
    try {
      $sth = $dbh->prepare($sql);
      $sth->execute(array(":id_fisc" => $id_fisc));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    $annee_fisc = $row['annee_fisc'];
    $isactive_fisc = $row['isactive_fisc'];
    $montant_fisc = $row['montant_fisc'];
  
    $message = "Vous vraimment activer la periode $annee_fisc ?";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ativer periode fiscale</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>ativer periode fiscale</h1>
<?php echo $message; ?></p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    <div><input name="annee_fisc" id="annee_fisc" type="hidden" value="<?php echo $annee_fisc ?>" /></div>
    <p>oui<br /><input name="isactive_fisc" id="isactive_fisc" type="checkbox" value="1"/></p>
    <div><input name="montant_fisc" id="montant_fisc" type="hidden" value="<?php echo $montant_fisc ?>" /><div>
    <div><input name="id_fisc" id="id_fisc" type="hidden" value="<?php echo $id_fisc; ?>" /></div>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;<input type="reset" value="Réinitialiser" /></p>
</form>
<p>Liste des <a href="gerer_periode.php">periodes fiscales</a></p>        
</body>
</html>