<?php
require_once __DIR__ . '/../../lib/fpdf/fpdf.php';
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../models/ver_reservas.php';


$conn = getConnection();
$modelo = new VerReservasModel($conn);
$id_usuario = $_SESSION['id_usuario'];
$reservas = $modelo->obtenerReservasPorUsuario($id_usuario);

if (empty($reservas)) {
    // En lugar de imprimir, redirige o lanza una excepción
    header("Location: index.php?controller=his_reservas&action=index&msg=noreservas");
    exit;
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Reporte de Reservas', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Nombre', 1);
$pdf->Cell(30, 10, 'Telefono', 1);
$pdf->Cell(30, 10, 'Ingreso', 1);
$pdf->Cell(30, 10, 'Salida', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
foreach ($reservas as $r) {
    $pdf->Cell(20, 10, $r['id_usuario'], 1);
    $pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $r['nombre_completo']), 1);
    $pdf->Cell(30, 10, $r['telefono'], 1);
    $pdf->Cell(30, 10, $r['fecha_ingreso'], 1);
    $pdf->Cell(30, 10, $r['fecha_salida'], 1);
    $pdf->Ln();
}

// 🔥 Limpia cualquier salida previa
ob_end_clean();

// Enviar PDF al navegador
$pdf->Output('I', 'reporte_reservas.pdf');
exit;
?>
