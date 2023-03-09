<?php

require('backend/connectionBdd.php');

$date_deplace = isset($_POST['date_deplace']) ? $_POST['date_deplace'] : '';
$id_motif = isset($_POST['id_motif']) ? $_POST['id_motif'] : '';
$lib_deplace = isset($_POST['lib_deplace']) ? $_POST['lib_deplace'] : '';
$nb_km = isset($_POST['nb_km']) ? $_POST['nb_km'] : '';
$frais_peage = isset($_POST['frais_peage']) ? $_POST['frais_peage'] : '';
$frais_repas = isset($_POST['frais_repas']) ? $_POST['frais_repas'] : '';
$frais_heber = isset($_POST['frais_heber']) ? $_POST['frais_heber'] : '';
$submit = isset($_POST['submit']);


if($submit){
    $id_nfrais = isset($_POST['id_nfrais']) ? $_POST['id_nfrais'] : NULL;
    $id_adherant = isset($_POST['id_adherant']) ? $_POST['id_adherant'] : NULL;
}else{
    $id_nfrais = isset($_GET['id_nfrais']) ? $_GET['id_nfrais'] : NULL;
    $id_adherant = isset($_POST['id_adherant']) ? $_POST['id_adherant'] : NULL;
    require('backend/CRUD_ligne_frais/ajout_auto_note.php');
}



$submit = isset($_POST['submit']);

if ($submit) {

    
try {
    $sql = "SELECT montant_fisc FROM periodefiscale";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $fisc = $sth->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

    try {
        $sql = "INSERT INTO lignefrais (date_deplace, id_motif, lib_deplace, nb_km, frais_peage, frais_repas, frais_heber, total_lfrais, id_nfrais) VALUES (:date_deplace , :id_motif , :lib_deplace, :nb_km, :frais_peage, :frais_repas, :frais_heber, :total_lfrais, :id_nfrais)";
        $params = array(
            ":date_deplace" => $date_deplace,
            ":id_motif" => $id_motif,
            ":lib_deplace" => $lib_deplace,
            ":nb_km" => $nb_km,
            ":frais_peage" => $frais_peage,
            ":frais_repas" => $frais_repas,
            ":frais_heber" => $frais_heber,
            ":id_nfrais" => $id_nfrais,
            ":total_lfrais" => $fisc["montant_fisc"]*$nb_km+$frais_peage + $frais_repas + $frais_heber
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    if ($sth->rowCount()) {
        header('location: note_util.php');
    } else {
        echo "<p> Essayez encore ! </p>";
    }
}
