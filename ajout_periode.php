<?php
session_start();

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
        die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
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
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="css/tableau.css">
</head>
<body>
<?php
    if (!isset($_SESSION['id_util'])) {
        header("Location: index.php");
    } else {
    ?>
        <?php include('header.php') ?>
<h1>ajouter une periode fiscale</h1>

<div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
    <div class="field padding-bottom--24">
        <label><?php echo $message." : "; ?></label><br>
        <label>Année fiscale</label>
        <input name="annee_fisc" id="annee_fisc" type="text" value="" required/>
    </div>
    <div class="field padding-bottom--24">
        <label>Montant fiscale</label>
        <input name="montant_fisc" id="montant_fisc" type="text" value="" required/>
    </div>
    <div class="field padding-bottom--24">
        <input type="submit" name="submit" value="Validée" />
            </div>
            <div class="field padding-bottom--24">
        <label>Liste des <a href="gerer_periode.php">periodes</a></label>
    </div>
            </form>
        </div>
    </div>
</div> 
<?php } ?>    
</body>
</html>