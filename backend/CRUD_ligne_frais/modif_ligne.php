<?php

$date_deplace = isset($_POST['date_deplace']) ? $_POST['date_deplace'] : '';
$id_motif = isset($_POST['id_motif']) ? $_POST['id_motif'] : '';
$lib_deplace = isset($_POST['lib_deplace']) ? $_POST['lib_deplace'] : '';
$nb_km = isset($_POST['nb_km']) ? $_POST['nb_km'] : '';
$frais_peage = isset($_POST['frais_peage']) ? $_POST['frais_peage'] : '';
$frais_repas = isset($_POST['frais_repas']) ? $_POST['frais_repas'] : '';
$frais_heber = isset($_POST['frais_heber']) ? $_POST['frais_heber'] : '';


if (isset($_GET['id_nfrais'])) {
    $id_nfrais = isset($_GET['id_nfrais']) ? $_GET['id_nfrais'] : '';
} else {
    $id_nfrais = isset($_POST['id_nfrais']) ? $_POST['id_nfrais'] : '';
}

if (isset($_GET['id_adherant'])) {
    $id_adherant = isset($_GET['id_adherant']) ? $_GET['id_adherant'] : '';
} else {
    $id_adherant = isset($_POST['id_adherant']) ? $_POST['id_adherant'] : '';
}

if (isset($_GET['id_lfrais'])) {
    $id_lfrais = isset($_GET['id_lfrais']) ? $_GET['id_lfrais'] : '';
} else {
    $id_lfrais = isset($_POST['id_lfrais']) ? $_POST['id_lfrais'] : '';
}




$submit = isset($_POST['submit']);


require('backend/connectionBdd.php');

if ($submit) {

    try {
        $sql = "SELECT montant_fisc FROM `periodefiscale` , notefrais WHERE notefrais.id_fisc=periodefiscale.id_fisc and id_nfrais=:id_nfrais";
        $params = array(
            "id_nfrais" => $id_nfrais
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $rows1 = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    foreach($rows1 as $row){
        $frais_km = $nb_km * $row['montant_fisc'];
    }

    $total_lfrais = $frais_km + $frais_peage + $frais_repas + $frais_heber;

    try {
        $sql = "UPDATE lignefrais set total_lfrais=:total_lfrais, date_deplace=:date_deplace, id_motif=:id_motif, lib_deplace=:lib_deplace, nb_km=:nb_km, frais_peage=:frais_peage, frais_repas=:frais_repas, frais_heber=:frais_heber where id_lfrais=:id_lfrais";
        $params = array(
            ":total_lfrais" => $total_lfrais,
            ":id_lfrais" => $id_lfrais,
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

    



    try {
        $sql = "SELECT total_lfrais from lignefrais where id_nfrais = :id_nfrais";
        $params = array(
            "id_nfrais" => $id_nfrais
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }
    $sum = 0;
    $count = count($rows);
    foreach ($rows as $row) {
        for($i=0;$i<$count;$i++){
            $sum = $row["total_lfrais"] + $sum;
        }
    }
    try {
        $sql = "UPDATE notefrais set tot_nfrais = :sum where id_nfrais = :id_nfrais";
        $params = array(
            "sum" => $sum,
            "id_nfrais" => $id_nfrais
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
    } catch (PDOException $e) {
        die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
    }

    header("location: note_util.php");
} else {
    try {

        $sql = "select date_deplace,lib_motif, lignefrais.id_motif, lib_deplace,nb_km,montant_fisc,frais_peage,frais_repas,frais_heber FROM lignefrais , notefrais , periodefiscale , motifdeplacement where motifdeplacement.id_motif = lignefrais.id_motif and lignefrais.id_nfrais = notefrais.id_nfrais and notefrais.id_fisc = periodefiscale.id_fisc and id_lfrais = :id_lfrais";
        $params = array(
            "id_lfrais" => $id_lfrais
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
        $row = $sth->fetch(PDO::FETCH_ASSOC);
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

    $message = "Veuillez réaliser la modification de l'ID $id_lfrais SVP";
}
