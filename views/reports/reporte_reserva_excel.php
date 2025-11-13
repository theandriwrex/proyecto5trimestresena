<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../models/ver_reservas.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

session_start();

$conn = getConnection();
$modelo = new VerReservasModel($conn);
$id_usuario = $_SESSION['id_usuario'];
$reservas = $modelo->obtenerReservasPorUsuario($id_usuario);

if (empty($reservas)) {
    header("Location: index.php?controller=his_reservas&action=index&msg=noreservas");
    exit;
}

// Crear nuevo libro de Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Encabezado
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nombre');
$sheet->setCellValue('C1', 'Telefono');
$sheet->setCellValue('D1', 'Ingreso');
$sheet->setCellValue('E1', 'Salida');

// Aplicar negrita  
$sheet->getStyle('A1:E1')->getFont()->setBold(true);

// Llenar filas
$fila = 2;
foreach ($reservas as $r) {
    $sheet->setCellValue("A{$fila}", $r['id_usuario']);
    $sheet->setCellValue("B{$fila}", $r['nombre_completo']);
    $sheet->setCellValue("C{$fila}", $r['telefono']);
    $sheet->setCellValue("D{$fila}", $r['fecha_ingreso']);
    $sheet->setCellValue("E{$fila}", $r['fecha_salida']);
    $fila++;
}

// Ajustar ancho automáticamente
foreach (range('A', 'E') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Crear el archivo Excel
$writer = new Xlsx($spreadsheet);

// Limpiar buffer antes de enviar
ob_clean();

// Configurar encabezados para descarga
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_reservas.xlsx"');
header('Cache-Control: max-age=0');

// Enviar el archivo
$writer->save('php://output');
exit;
?>
