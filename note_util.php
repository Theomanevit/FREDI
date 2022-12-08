<?php

session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];


require("backend/connectionBdd.php");

if (isset($_SESSION['iscontrol'])) {
    $sql = 'select id_nfrais, tot_nfrais, date_ordre, num_ordre from notefrais where isvalid="1"'; 
}
if (isset($_SESSION['isadmin'])) {
    header("location: index.php");
}
if (!isset($_SESSION['isadmin']) && !isset($_SESSION['iscontrol'])) {
    $sql = 'select id_nfrais, tot_nfrais, date_ordre, num_ordre from notefrais, adherant where notefrais.id_adherant=adherant.id_adherant and adherant.id_util= '.$_SESSION["id_util"].' and isvalid="1"';
}

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
    <title>Liste des notes utilisateurs</title>
    <link rel="stylesheet" href="css/tableau.css">
</head>
<body>
<?php include('header.php') ?>
<h1>Liste des notes utilisateurs</h1>
<?php
if (count($rows)>0) {
    echo '<table>';
    echo '<tr><th>idantifiant note</th><th>frais total</th><th>date ordre</th><th>numero ordre</th><th></th></tr>';
    foreach ($rows as $row){

      echo '<tr>';
      echo '<td>'.$row['id_nfrais'].'</td>';
      echo '<td>'.$row['tot_nfrais'].'</td>';
      echo '<td>'.$row['date_ordre'].'</td>';
      echo '<td>'.$row['num_ordre'].'</td>';
      echo '<td><button><a href="ligne_notes.php?id_nfrais='.$row['id_nfrais'].'">afficher ligne</a></button></td>';
      echo "</tr>";

}
    echo "</table>";
} else {
    echo "<p>Rien à afficher</p>";
}
?>  
</body>
</html>