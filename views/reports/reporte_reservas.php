<?php
require __DIR__ . '/../../lib/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Reporte de Reservas',0,1,'C');
$pdf->output();
?>