<?php
session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];

require('backend/connectionBdd.php');

$id_nfrais = isset($_GET['id_nfrais']) ? $_GET['id_nfrais'] : '';

$sql = 'select * FROM lignefrais , notefrais , periodefiscale , motifdeplacement where motifdeplacement.id_motif = lignefrais.id_motif and lignefrais.id_nfrais = notefrais.id_nfrais and notefrais.id_fisc = periodefiscale.id_fisc';

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tableau.css">
    <title>liste ligne de frais</title>
</head>
<body>
    <?php include('header.php');

if (count($rows)>0) {
    echo '<table>';
    echo '<tr><th>date</th><th>motif</th><th>trajet</th><th>nombre km</th><th>Frais km</th><th>montant péage</th><th>montant repas</th><th>montant hébergement</th><th>modifier</th><th>supprimer</th></tr>';
    foreach ($rows as $row){

      echo '<tr>';
      echo '<td>'.$row['date_deplace'].'</td>';
      echo '<td>'.$row['lib_motif'].'</td>';
      echo '<td>'.$row['lib_deplace'].'</td>';
      echo '<td>'.$row['nb_km'].'</td>';
      $frais_km = $row['nb_km'] * $row['montant_fisc'];
      echo '<td>' . $frais_km . '</td>';
      echo '<td>'.$row['frais_peage'].'</td>';
      echo '<td>'.$row['frais_repas'].'</td>';
      echo '<td>'.$row['frais_heber'].'</td>';
      echo '<td></td>'; //ici lien modifier
      echo '<td></td>'; //ici lien supprimer
      echo "</tr>";

}
    echo "</table>";
} else {
    echo "<p>Rien à afficher</p>";
}
?>
<a href="formulaire_ajout.php">Ajouter une ligne de frais

</body>
</html>