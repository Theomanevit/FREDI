<?php

session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];


require("backend/connectionBdd.php");

$sql = 'select id_util, Pseudo_util, Nom_util, Prenom_util, Mail_util, isadmin, iscontrol   from utilisateur';

try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="css/tableau.css">
</head>
<body>
<?php include('header.php') ?>
<h1>Liste des utilisateurs</h1>
<?php
if (count($rows)>0) {
    echo '<table>';
    echo '<tr><th>pseudo</th><th>Nom</th><th>Prénom</th><th>adresse mail</th><th>role</th><th></th></tr>';
    foreach ($rows as $row){
    $chaine='adhérant';
    if ($row['isadmin']==1){
        $chaine="administrateur";
        }
    if ($row['iscontrol']==1){
        $chaine="controleur";
        }

      echo '<tr>';
      echo '<td>'.$row['Pseudo_util'].'</td>';
      echo '<td>'.$row['Nom_util'].'</td>';
      echo '<td>'.$row['Prenom_util'].'</td>';
      echo '<td>'.$row['Mail_util'].'</td>';
      echo '<td>'.$chaine.'</td>';
      echo '<td><button><a href="attribution_roles.php?id_util='.$row['id_util'].'">modifier</a></button></td>';
      echo "</tr>";

}
    echo "</table>";
} else {
    echo "<p>Rien à afficher</p>";
}
?>  
</body>
</html>