<?php

session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];


$dsn = 'mysql:host=localhost;dbname=fredi21';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Erreur lors de la connexion SQL : " . $ex->getMessage());
}

$id_util = isset($_GET['id_util']) ? $_GET['id_util'] : '';
$isadmin = isset($_POST['isadmin']) ? $_POST['isadmin'] : '';
$iscontrol = isset($_POST['iscontrol']) ? $_POST['iscontrol'] : '';
$submit = isset($_POST['submit']);

// Ajout dans la base
if ($submit) {
    $id_util = $_POST['id_util'];
    if ($isadmin==1 && $iscontrol==1){
        $message= "erreur un utilisateur ne peut être administrateur et controleur";
    }
    else {
    $sql="update utilisateur set isadmin=:isadmin, iscontrol=:iscontrol where id_util=:id_util";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":isadmin"=>$isadmin,":iscontrol"=>$iscontrol,":id_util"=>$id_util));
        $nb = $sth->rowcount();
      } catch (PDOException $e) {
        die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    $message="$nb roles modifié";
}

} else {
    $sql = "select * from utilisateur where id_util=:id_util";
    try {
      $sth = $dbh->prepare($sql);
      $sth->execute(array(":id_util" => $id_util));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    $isadmin = $row['isadmin'];
    $iscontrol = $row['iscontrol'];

    $message = "Veuillez réaliser la modification de l'ID $id_util SVP";
}
//mise a jour des radios
if ($isadmin==0){
    $check1="";
    $check2="checked";
}else {
    $check2="";
    $check1="checked";
}

if ($iscontrol==0){
    $check3="";
    $check4="checked";
}else {
    $check4="";
    $check3="checked";
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>attribution roles</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<h1>attribution roles</h1>
<?php echo $message; ?></p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <p>Admin ? <br/>
    <input name="isadmin" id="isadmin" type="radio" value="1" <?= $check1 ?> />Oui<br/>
    <input name="isadmin" id="isadmin" type="radio" value="0"  <?= $check2 ?> />Non</p>
    
    <p>controleur ? <br/>
    <input name="iscontrol" id="iscontrol" type="radio" value="1"  <?= $check3 ?> />Oui<br/>
    <input name="iscontrol" id="iscontrol" type="radio" value="0" <?= $check4 ?> />Non</p>
    <div><input name="id_util" id="id_util" type="hidden" value="<?php echo $id_util; ?>" /></div>
    <p><input type="submit" name="submit" value="Envoyer" />&nbsp;</p>
</form>
<p>Liste des <a href="list_util.php">utilisateurs</a></p>        
</body>
</html>