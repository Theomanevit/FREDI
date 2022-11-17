<?php

$date_deplace = isset($_POST['date_deplace']) ? $_POST['date_deplace'] : '';
$id_motif = isset($_POST['id_motif']) ? $_POST['id_motif'] : '';
$lib_deplace = isset($_POST['lib_deplace']) ? $_POST['lib_deplace'] : '';
$nb_km = isset($_POST['nb_km']) ? $_POST['nb_km'] : '';
$frais_peage = isset($_POST['frais_peage']) ? $_POST['frais_peage'] : '';
$frais_repas = isset($_POST['frais_repas']) ? $_POST['frais_repas'] : '';
$frais_heber = isset($_POST['frais_heber']) ? $_POST['frais_heber'] : '';
$submit = isset($_POST['submit']);

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