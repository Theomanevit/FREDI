<?php
session_start();
/**
 * Détails en PDF
 */
require('backend/connectionBdd.php');

try {
    $sql = "SELECT nom_util,prenom_util,adresse,cp,ville,lib_club,adresse_club,cp_club,ville_club,lib_ligue FROM adherant,clubs,utilisateur,ligues WHERE utilisateur.id_util=adherant.id_util AND clubs.id_club=adherant.id_club AND ligues.id_ligue=clubs.id_ligue AND utilisateur.id_util = :id_util";
    $params = array(
        ":id_util" =>$_SESSION["id_util"]
    );
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $row = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}


require_once "init.php";

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('infiles/cerfa.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId);

$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(10, 37);
$pdf->Write(0, utf8_decode($row["lib_club"]));

$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(15, 45);
$pdf->Write(0, "                     ".utf8_decode($row["adresse_club"]));

$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(30, 50);
$pdf->Write(0, utf8_decode($row["cp_club"])."                            ".utf8_decode($row["ville_club"]));

$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(25, 57);
$pdf->Write(0, utf8_decode($row["lib_ligue"]));

$pdf->SetFont('Helvetica', '', 20);
$pdf->SetXY(10, 75);
$pdf->Write(0, "X");

$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(12, 167);
$pdf->Write(0, utf8_decode($row["nom_util"])."   ".utf8_decode($row["prenom_util"]));

$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(12, 175);
$pdf->Write(0, utf8_decode($row["adresse"]));

$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(30, 180);
$pdf->Write(0, utf8_decode($row["cp"]));

$pdf->SetFont('Helvetica', '', 10);
$pdf->SetXY(70, 180);
$pdf->Write(0, utf8_decode($row["ville"]));

$pdf->Output('F', 'outfiles/cerfa_'.$row["nom_util"].'_'.$row["prenom_util"].'.pdf');
header('Location: index.php');
