<?php
session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];

require('backend/connectionBdd.php');

$id_nfrais = isset($_GET['id_nfrais']) ? $_GET['id_nfrais'] : '';

$sql = 'select date_deplace, lib_deplace, nb_km, frais_peage, frais_repas, frais_heber, lib_motif, total_lfrais from lignefrais, motifdeplacement where motifdeplacement.id_motif=lignefrais.id_motif and lignefrais.id_nfrais=:id_nfrais';

try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(":id_nfrais"=>$id_nfrais));
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>liste ligne de frais</title>
</head>
<body>
    <?php include('header.php');

if (count($rows)>0) {
    echo '<table>';
    echo '<tr><th>date</th><th>libellé trajet</th><th>nombre km</th><th>montant péage</th><th>montant repas</th><th>montant hébergement</th><th>motif</th><th>modifier</th><th>supprimer</th></tr>';
    foreach ($rows as $row){

      echo '<tr>';
      echo '<td>'.$row['date_deplace'].'</td>';
      echo '<td>'.$row['lib_lfrais'].'</td>';
      echo '<td>'.$row['nb_km'].'</td>';
      echo '<td>'.$row['frais_peage'].'</td>';
      echo '<td>'.$row['frais_repas'].'</td>';
      echo '<td>'.$row['frais_heber'].'</td>';
      echo '<td>'.$row['lib_motif'].'</td>';
      echo "</tr>";

}
    echo "</table>";
} else {
    echo "<p>Rien à afficher</p>";
}
?>

</body>
</html>