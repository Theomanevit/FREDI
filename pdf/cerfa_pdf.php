<?php
/**
 * Liste des services en PDF
 */
require_once "init.php";
require_once "fpdf/fpdf.php";


// Instanciation de l'objet dérivé
$pdf = new MON_PDF();

// Metadonnées
$pdf->SetTitle('Exemple pdf', true);
$pdf->SetAuthor('FREDI', true);
$pdf->SetSubject('cerfa_pdf', true);
$pdf->mon_fichier="cerfa.pdf";

// Création d'une page
$pdf->AddPage();

// Définit l'alias du nombre de pages {nb}
$pdf->AliasNbPages();

// Titre de page
$pdf->SetFont('Times', '', 24);
$pdf->SetTextColor(0, 51, 255); // Bleu  #0033FF
$pdf->Cell(0, 20, utf8_decode("Cerfa"), 0, 1, 'C');
$pdf->Ln(8);

// Boucle des lignes
$pdf->SetFont('Times', '', 12);
$pdf->SetTextColor(0, 0, 0); // Noir
// Entête
$pdf->SetFont('', 'B');
$pdf->SetX(20);
$pdf->SetFillColor(211,211,211);
$pdf->Cell(30, 5, utf8_decode("ID"), 1,0,"C",true);
$pdf->Cell(50, 5, utf8_decode("Libellé"), 1,1,"C",true);

// Génération du document PDF
$pdf->Output('f','outfiles/'.$pdf->mon_fichier);
header('Location: cerfa.php');