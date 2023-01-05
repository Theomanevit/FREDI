<?php
session_start();
/**
 * Détails en PDF
 */
require('backend/connectionBdd.php');

try {
    $sql = "SELECT tot_nfrais,lib_motif,lib_club,lib_ligue
    FROM notefrais , motifdeplacement , lignefrais , clubs , adherant,ligues
    WHERE motifdeplacement.id_motif=lignefrais.id_motif
    and lignefrais.id_nfrais=notefrais.id_nfrais
    and notefrais.id_adherant=adherant.id_adherant
    and adherant.id_club=clubs.id_club
    and clubs.id_ligue=ligues.id_ligue";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $tot_nfrais = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die( "<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
  }

require_once "init.php";



// Instanciation de l'objet dérivé
$pdf = new FPDF();

// Metadonnées
$pdf->SetTitle('cumul_frais ', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('cumul des frais', true);


// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->SetMargins(2,10,40);
$pdf->AliasNbPages();

// Titre de page
$pdf->SetFont('Times', '', 16);
$pdf->Cell(0, 8, utf8_decode('Cumul des frais'), 0, 0, 'C');
$pdf->Ln(10);

// Contenu
$pdf->SetFont('helvetica', '', 8);
$pdf->SetX(10);
$pdf->Cell(50, 10, utf8_decode("ligue"), 1, 0, 'L');
$pdf->Cell(30, 10, utf8_decode("club"), 1, 0, 'L');
$pdf->Cell(30, 10, utf8_decode("motif"), 1, 0, 'L');
$pdf->Cell(30, 10, utf8_decode("total des frais"), 1, 1, 'L');
$cal_total_frais=0;
foreach($tot_nfrais as $tot_nfrai){
    $pdf->SetTextColor(0,31,243);
    $pdf->SetX(10);
    $pdf->Cell(50, 7, utf8_decode($tot_nfrai["lib_ligue"]), 1, 0, 'L');
    $pdf->Cell(30, 7, utf8_decode($tot_nfrai["lib_club"]), 1, 0, 'L');
    $pdf->Cell(30, 7, utf8_decode($tot_nfrai["lib_motif"]), 1, 0, 'L');
    $pdf->Cell(30, 7, utf8_decode($tot_nfrai["tot_nfrais"]), 1, 1, 'L');
}

// Génération du document PDF
$pdf->Output('f','outfiles/cumul_frais.pdf');
header('Location: index.php');