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

if ($submit) {

    try {
        $id_lfrais = $_POST['id_lfrais'];
        $sql = "UPDATE lignefrais set date_deplace=:date_deplace, id_motif=:id_motif, lib_deplace=:lib_deplace, nb_km=:nb_km, frais_peage=:frais_peage, frais_repas=:frais_repas, frais_heber=:frais_heber where id_util=:id_util";
        $params = array(
            ":id_util" => $_SESSION["id_util"],
            ":date_deplace" => $date_deplace,
            ":id_motif" => $id_motif,           // Raison du déplacement
            ":lib_deplace" => $lib_deplace,     // Le nom du trajet ville - ville
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
} else {
    try {
        $sql = "select date_deplace,lib_motif,lib_deplace,nb_km,montant_fisc,frais_peage,frais_repas,frais_heber FROM lignefrais , notefrais , periodefiscale , motifdeplacement where motifdeplacement.id_motif = lignefrais.id_motif and lignefrais.id_nfrais = notefrais.id_nfrais and notefrais.id_fisc = periodefiscale.id_fisc";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(":id_lfrais" => $id_lfrais));
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        die("<p>Erreur lors de la requête SQL : " . $ex->getMessage() . "</p>");
    }
    $date_deplace = $row['date_deplace'];
    $id_motif = $row['id_motif'];
    $lib_deplace = $row['lib_deplace'];
    $nb_km = $row['nb_km'];
    $frais_peage = $row['frais_peage'];
    $frais_repas = $row["frais_repas"];
    $frais_heber = $row['frais_heber'];
  
    $message = "Veuillez réaliser la modification de l'ID $id SVP";
}