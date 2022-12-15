<?php
session_start();



require('backend/connectionBdd.php');


$id_nfrais = isset($_GET['id_nfrais']) ? $_GET['id_nfrais'] : '';
$id_adherant = isset($_GET['id_adherant']) ? $_GET['id_adherant'] : '';


$sql = 'select id_lfrais, montant_fisc, lib_deplace, date_deplace, frais_peage, frais_repas, frais_heber, nb_km, total_lfrais, lignefrais.id_nfrais, motifdeplacement.lib_motif
FROM lignefrais , notefrais , periodefiscale , motifdeplacement, adherant
where motifdeplacement.id_motif = lignefrais.id_motif 
and lignefrais.id_nfrais = notefrais.id_nfrais 
and notefrais.id_fisc = periodefiscale.id_fisc 
and adherant.id_adherant = :id_adherant
and notefrais.id_nfrais = :id_nfrais';

$params = array(
":id_adherant" => $id_adherant,
":id_nfrais" => $id_nfrais
);

try {
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
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
  echo '<div class="haut">';
    echo '<table>';
    echo '<tr><th>date</th><th>motif</th><th>trajet</th><th>nombre km</th><th>Frais km</th><th>montant péage</th><th>montant repas</th><th>montant hébergement</th><th>total</th><th>modifier</th><th>supprimer</th></tr>';
    foreach ($rows as $row){

      echo '<tr>';
      echo '<td>'.$row['date_deplace'].'</td>';
      echo '<td>'.$row['lib_motif'].'</td>';
      echo '<td>'.$row['lib_deplace'].'</td>';
      echo '<td>'.$row['nb_km'].'</td>';
      $frais_km = $row['nb_km'] * $row['montant_fisc'];
      echo '<td>' . $frais_km . ' €</td>';
      echo '<td>'.$row['frais_peage'].' €</td>';
      echo '<td>'.$row['frais_repas'].' €</td>';
      echo '<td>'.$row['frais_heber'].' €</td>';
      $total_lfrais = $frais_km + $row['frais_peage'] + $row['frais_repas'] + $row['frais_heber'];
      echo '<td>'.$total_lfrais .' €</td>';
      echo '<td><a href="fomulaire_modif.php?id='.$row['id_lfrais'].'"> modifier<a></td>';
      echo '<td><a href="fomulaire_suppr.php?id='.$row['id_lfrais'].'"> supprimer<a></td>';
      echo "</tr>";

}
    echo "</table>";
    echo '</div>';
    // mettre insert total ligne
} else {
    echo "<p>Rien à afficher</p>";
}
?>
<p><a href="fomulaire_ajout.php?id_nfrais=<?php echo $id_nfrais ?>"> ajouter une ligne de frais<a></p>

</body>
</html>