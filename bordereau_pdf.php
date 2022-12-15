<?php
/**
 * Détails en PDF
 */
require_once "init.php";

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

$pdf = new Fpdi();

$pageCount = $pdf->setSourceFile('infiles/bordereau.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId);

$pdf->Output('F', 'outfiles/bordereau.pdf');
header('Location: index.php');