<?php
ob_clean(); 
require_once __DIR__ . '/../../lib/fpdf/fpdf.php';

if (!isset($_SESSION['reserva_individual'])) {
    die("No se encontró la reserva.");
}

$r = $_SESSION['reserva_individual'];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Detalle de la Reserva #' . $r['id_reserva'], 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(60, 10, 'Nombre: ' . $r['nombre_completo'], 0, 1);
$pdf->Cell(60, 10, 'Telefono: ' . $r['telefono'], 0, 1);
$pdf->Cell(60, 10, 'Ingreso: ' . $r['fecha_ingreso'], 0, 1);
$pdf->Cell(60, 10, 'Salida: ' . $r['fecha_salida'], 0, 1);
$pdf->Output('I', 'reserva_' . $r['id_reserva'] . '.pdf');
exit;
?>
