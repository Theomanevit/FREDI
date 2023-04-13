<?php

session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];


require("backend/connectionBdd.php");

if (isset($_SESSION['iscontrol'])) {
    $sql = 'select pseudo_util , isvalid, id_nfrais, tot_nfrais, date_ordre, num_ordre 
    from notefrais as nf, periodefiscale as pf , adherant as ad , utilisateur as ut
    where nf.id_fisc = pf.id_fisc
    and nf.id_adherant = ad.id_adherant
    and ad.id_util = ut.id_util
    and isactive_fisc= 1';
}
if (isset($_SESSION['isadmin'])) {
    header("location: index.php");
}
if (!isset($_SESSION['isadmin']) && !isset($_SESSION['iscontrol'])) {
    $sql = 'select isvalid, id_nfrais, tot_nfrais, date_ordre, num_ordre, nf.id_adherant from notefrais as nf, adherant as a, periodefiscale as pf where nf.id_adherant = a.id_adherant and nf.id_fisc = pf.id_fisc and a.id_util= ' . $_SESSION["id_util"] . ' and isactive_fisc= 1 and isvalid = 0';
}

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
    <title>Liste des notes utilisateurs</title>
    <link rel="stylesheet" href="css/tableau.css">
</head>

<body>
    <?php include('header.php') ?>
    <h1>Liste des notes utilisateurs</h1>
    <?php
    if (count($rows) > 0) {
        echo '<table>';

       

            if (!isset($_SESSION['isadmin']) && !isset($_SESSION['iscontrol'])) {
                echo '<tr><th>idantifiant note</th><th>frais total</th><th>date ordre</th><th>numero ordre</th><th></th></tr>';
                foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>' . $row['id_nfrais'] . '</td>';
                echo '<td>' . $row['tot_nfrais'] . '</td>';
                echo '<td>' . $row['date_ordre'] . '</td>';
                echo '<td>' . $row['num_ordre'] . '</td>';
                echo '<td><button><a href="ligne_notes.php?id_nfrais=' . $row['id_nfrais'] . '&id_adherant=' . $row['id_adherant'] . '">afficher ligne</a></button></td>';
                echo "</tr>";
                }
            }
            if (isset($_SESSION['iscontrol'])) {
                echo '<tr><th>utilisateur</th><th>Note de frais validée ?</th><th>idantifiant note</th><th>frais total</th><th>date ordre</th><th>numero ordre</th><th></th><th></th></tr>';
                foreach ($rows as $row) {
                echo '<tr>';
                echo '<td>' . $row['pseudo_util']  . '</td>';
                echo '<td>' . $row['isvalid'] . '</td>';
                echo '<td>' . $row['id_nfrais'] . '</td>';
                echo '<td>' . $row['tot_nfrais'] . '</td>';
                echo '<td>' . $row['date_ordre'] . '</td>';
                echo '<td>' . $row['num_ordre'] . '</td>';
                echo '<td><button><a href="ligne_notes.php?id_nfrais=' . $row['id_nfrais'] . '">afficher ligne</a></button></td>';
                if($row['isvalid']==0){
                    echo '<td><button><a href="valider_note_frais.php?id_nfrais=' . $row['id_nfrais'] . '">Valider note de frais</a></button></td>';
                } else {
                    echo '<td>La note est validée</td>';
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<br>";
        }



    } else {
        echo '<p>Aucune note de frais</p>';
        if(!isset($_SESSION['iscontrol']))
            echo '<a href="fomulaire_ajout.php">[ajouter une ligne de frais]</a>';
    }
    if (isset($_SESSION['iscontrol'])) {
        echo '<button><a href="gerer_periode.php">gérer les periodes</a></button>';
        echo '<div><p>Création : <a href="cumul_frais_pdf.php">pdf cumul des frais</a></p></div>';
    }
    ?>
</body>

</html>