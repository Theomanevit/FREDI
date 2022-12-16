<?php
session_start();
/**
 * Détails en PDF
 */
require('backend/connectionBdd.php');

try {
    $sql = "SELECT YEAR(date_ordre) as date_ordre,nom_util,prenom_util,adresse,cp,ville,lib_club,adresse_club,cp_club,ville_club,num_licence,id_nfrais 
    FROM notefrais,utilisateur,adherant,clubs 
    WHERE adherant.id_club=clubs.id_club 
    AND adherant.id_util=utilisateur.id_util 
    and notefrais.id_adherant=adherant.id_adherant 
    and utilisateur.id_util= :id_util";
    $params = array(
        ":id_util" =>$_SESSION["id_util"]
    );
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

try {
    $sql = "SELECT montant_fisc FROM periodefiscale";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $fisc = $sth->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

try {
    $sql = "SELECT date_deplace,lib_motif,lib_deplace , nb_km,nb_km*montant_fisc as total_frais_km  , frais_peage,frais_repas,frais_heber,total_lfrais 
    FROM notefrais,utilisateur,adherant,motifdeplacement,lignefrais,periodefiscale 
    WHERE adherant.id_util=utilisateur.id_util 
    and notefrais.id_adherant=adherant.id_adherant 
    and notefrais.id_fisc=periodefiscale.id_fisc 
    and notefrais.id_nfrais=lignefrais.id_nfrais 
    and lignefrais.id_motif=motifdeplacement.id_motif 
    and utilisateur.id_util= :id_util 
    and notefrais.id_nfrais= :id_nfrais";
    $params = array(
        ":id_util" =>$_SESSION["id_util"],
        ":id_nfrais"=>$row["id_nfrais"]
    );
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $frais = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}



require_once "init.php";

// Instanciation de l'objet dérivé
$pdf = new FPDF();

// Metadonnées
$pdf->SetTitle('bordereau ', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('note de frais des bénévoles', true);


// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->SetMargins(2,10,40);
$pdf->AliasNbPages();

// Titre de page
$pdf->SetFont('Times', '', 16);
$pdf->Cell(0, 20, utf8_decode('Note de frais des bénévoles'), 0, 0, 'L');
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 20, utf8_decode("Année civile ".$row["date_ordre"]), 0, 1, 'R');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

// Contenu
$pdf->SetFont('helvetica', '', 8);
$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("Je soussigné(e)"), 0, 0, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 20, utf8_decode($row["nom_util"]."  ".$row["prenom_util"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("demeurant"), 0, 0, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 20, utf8_decode($row["adresse"]." - ".$row["cp"]." - ".$row["ville"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association"), 0, 1, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 20, utf8_decode($row["lib_club"]), 0, 1, 'C');
$pdf->Cell(0, 0, utf8_decode($row["adresse_club"]." - ".$row["cp_club"]." - ".$row["ville_club"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("en tant que don."), 0, 1, "L");
$pdf->Ln(5);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("Frais de déplacement"), 0, 1, "L");
$pdf->Cell(30, 8, utf8_decode("Tarif kilométrique appliqué pour le rembourssement : ".$fisc["montant_fisc"]." euro"), 0, 1, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 20, utf8_decode($row["nom_util"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);


$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("Je suis licencié sous le n° de licence suivant :"), 0, 0, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 20, utf8_decode($row["nom_util"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("Montant total des dons"), 0, 0, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 20, utf8_decode($row["nom_util"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("Pour bénéficier du reçu de dons, cette note de frais doit être accompagnée de toutes les justificatifs correspondants"), 0, 0, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 20, utf8_decode($row["nom_util"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(5);

// Génération du document PDF
$pdf->Output('f','outfiles/bordereau_'.$row["nom_util"].'_'.$row["prenom_util"].'.pdf');
header('Location: index.php');