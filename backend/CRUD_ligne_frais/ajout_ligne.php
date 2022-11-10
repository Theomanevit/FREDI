<?php

session_start();

include("functions.php");
// Récupère le nom du fichier PHP
$tableau = pathinfo(__FILE__);
$filename = $tableau['basename'];

require('backend/connectionBdd.php');

$submit = isset($_POST['submit']);

if ($submit) {
    try {
        $sql = "INSERT INTO lignefrais(date_deplace, id_motif, lib_deplace, nb_km, frais_peage, frais_repas, frais_heber) VALUES (:date_deplace , :id_motif , :lib_deplace, :nb_km, :frais_peage, :frais_repas, :frais_heber)";
        $params = array(
            ":date_deplace" => $date_deplace,
            ":id_motif" => $id_motif,
            ":lib_deplace" => $lib_deplace,
            ":nb_km" => $nb_km,
            ":frais_peage" => $frais_peage,
            ":frais_repas" => $frais_repas,
            ":frais_heber" => $frais_heber
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    if ($sth->rowCount()) {
        header('location: ligne_notes.php');
    } else {
        echo "<p> Essayez encore ! </p>";
    }
}
?>