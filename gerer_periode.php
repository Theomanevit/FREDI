<?php

session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];


require("backend/connectionBdd.php");
if (isset($_SESSION['iscontrol'])) {
    $sql = 'select id_fisc, annee_fisc, isactive_fisc, montant_fisc from periodefiscale';


try {
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des périodes fiscales</title>
    <link rel="stylesheet" href="css/tableau.css">
</head>

<body>
    <?php include('header.php') ?>
    <h1>Liste des periodes fiscales </h1>
    <?php
    if (count($rows) > 0) {
        echo '<table>';
        echo '<tr><th>idantifiant</th><th>année</th><th>periode active</th><th>montant fiscale</th><th></th></tr>';
        foreach ($rows as $row) {

            
                echo '<tr>';
                echo '<td>' . $row['id_fisc'] . '</td>';
                echo '<td>' . $row['annee_fisc'] . '</td>';
                if ($row['isactive_fisc']==1){
                    echo '<td> oui </td>';
                }
                else
                {
                    echo '<td> non </td>';
                }
                echo '<td>' . $row['montant_fisc'] . '</td>';
                if ($row['isactive_fisc']==0){
                    echo '<td><button><a href="activer_periode.php?id_fisc=' . $row['id_fisc'] . '&id_adherant=' . $row['id_adherant'] . '">activer</a></button></td>';
                }
                echo "</tr>";
                
            
            
        }

        echo "</table>";



    }
    echo '<a href="ajout_periode.php">[ajouter une periode]</a>';
    }
    ?>
</body>

</html>