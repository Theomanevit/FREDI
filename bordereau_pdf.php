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

$id_nfrais=$row["id_nfrais"];

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
        ":id_nfrais"=>$id_nfrais
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
$pdf->Cell(0, 8, utf8_decode('Note de frais des bénévoles'), 0, 0, 'L');
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 8, utf8_decode("Année civile ".$row["date_ordre"]), 0, 1, 'R');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(10);

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
$pdf->Cell(0, 8, utf8_decode($row["adresse"]." - ".$row["cp"]." - ".$row["ville"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(2);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association"), 0, 1, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 8, utf8_decode($row["lib_club"]), 0, 1, 'C');
$pdf->Cell(0, 0, utf8_decode($row["adresse_club"]." - ".$row["cp_club"]." - ".$row["ville_club"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(2);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("en tant que don."), 0, 1, "L");
$pdf->Ln(2);


$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("Frais de déplacement"), 0, 0, "L");
$pdf->Cell(30, 8, utf8_decode("                  Tarif kilométrique appliqué pour le rembourssement : ".$fisc["montant_fisc"]." euro"), 0, 1, "L");
$pdf->Ln(1);
$pdf->SetX(10);
$pdf->Cell(25, 10, utf8_decode("Date jj/mm/aaaa"), 1, 0, 'L');
$pdf->Cell(25, 10, utf8_decode("Motif"), 1, 0, 'L');
$pdf->Cell(25, 10, utf8_decode("Trajet"), 1, 0, 'L');
$pdf->Cell(22, 10, utf8_decode("Kms parcourus"), 1, 0, 'L');
$pdf->Cell(22, 10, utf8_decode("Total frais Kms"), 1, 0, 'L');
$pdf->Cell(20, 10, utf8_decode("Coût péages"), 1, 0, 'L');
$pdf->Cell(18, 10, utf8_decode("Coût repas"), 1, 0, 'L');
$pdf->Cell(26, 10, utf8_decode("Coût hébergement"), 1, 0, 'L');
$pdf->Cell(15, 10, utf8_decode("Total"), 1, 1, 'L');
$cal_total_frais=0;
foreach($frais as $frai){
    $pdf->SetTextColor(0,31,243);
    $pdf->SetX(10);
    $pdf->Cell(25, 7, utf8_decode($frai["date_deplace"]), 1, 0, 'L');
    $pdf->Cell(25, 7, utf8_decode($frai["lib_motif"]), 1, 0, 'L');
    $pdf->Cell(25, 7, utf8_decode($frai["lib_deplace"]), 1, 0, 'L');
    $pdf->Cell(22, 7, utf8_decode($frai["nb_km"]), 1, 0, 'L');
    $pdf->Cell(22, 7, utf8_decode($frai["total_frais_km"]), 1, 0, 'L');
    $pdf->Cell(20, 7, utf8_decode($frai["frais_peage"]), 1, 0, 'L');
    $pdf->Cell(18, 7, utf8_decode($frai["frais_repas"]), 1, 0, 'L');
    $pdf->Cell(26, 7, utf8_decode($frai["frais_heber"]), 1, 0, 'L');
    $pdf->Cell(15, 7, utf8_decode($frai["total_lfrais"]), 1, 1, 'L');
    $cal_total_frais=$frai["total_lfrais"]+$cal_total_frais;
}
$pdf->SetX(10);
$pdf->Cell(183, 7, utf8_decode("Montant total des frais de déplacement"), 1, 0, 'L');
$pdf->Cell(15, 7, utf8_decode("$cal_total_frais"), 1, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(2);
$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("Je suis licencié sous le n° de licence suivant :"), 0, 0, "L");
$pdf->Ln(1);
$pdf->SetTextColor(0,31,243);
$pdf->Cell(0, 8, utf8_decode("Licence n° ".$row["num_licence"]), 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(1);

$pdf->SetX(10);
$pdf->Cell(30, 8, utf8_decode("Montant total des dons"), 0, 0, "L");
$pdf->SetTextColor(0,31,243);
$pdf->Cell(30, 8, utf8_decode("           $cal_total_frais"), 0, 1, 'L');
$pdf->SetTextColor(0,0,0);
$pdf->Ln(2);

$pdf->SetX(30);
$pdf->Cell(30, 8, utf8_decode("Pour bénéficier du reçu de dons, cette note de frais doit être accompagnée de toutes les justificatifs correspondants"), 0, 1, "L");
$pdf->Ln(2);

$pdf->SetX(100);
$pdf->Cell(30, 8, utf8_decode("A                               Le               "), 0, 1, "L");
$pdf->Ln(2);

$pdf->SetX(60);
$pdf->Cell(30, 20, utf8_decode("Signature du bénévole"), 0, 1, "L");
$pdf->Ln(2);

$pdf->SetX(10);
$pdf->Cell(100, 8, utf8_decode("Partie réservée à l'association"), "LTR", 1, "C");
$pdf->SetX(10);
$pdf->Cell(100, 8, utf8_decode("N° d'ordre du Reçu : 2009-007"), "LR", 1, "L");
$pdf->SetX(10);
$pdf->Cell(100, 8, utf8_decode("Remis le : "), "LR", 1, "L");
$pdf->SetX(10);
$pdf->Cell(100, 8, utf8_decode("Signature du Trésorier : "), "LBR", 1, "L");

// Génération du document PDF
$pdf->Output('f','outfiles/bordereau_'.$row["nom_util"].'_'.$row["prenom_util"].'.pdf');
header('Location: index.php');