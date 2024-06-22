<?php
// Importar la biblioteca FPDF
require_once './fpdf/fpdf.php';

// Crear una nueva instancia de FPDF
$pdf = new FPDF();

// Establecer el tamaño del papel y la orientación
//$pdf->SetPaper(A4, landscape);
$pdf->AddPage('L'); // L indica landscape
$pdf->SetMargins(15, 25, 15); // Ajustar márgenes si es necesario

// Imprimir el encabezado
$pdf->SetFont('Arial', 'B', 16, 'UTF-8');
$pdf->Cell(0, 10, utf8_decode('Indicaciones Médicas'), 0, 1, 'C');

$id = $_GET['id'];
$pid=$id;
// Consulta SQL para obtener los datos del paciente
include("../connection.php");
$userrow = $database->query("SELECT p.pname, r.medicamento, r.descripcion, r.fecha, DATE_FORMAT(DATE_ADD(r.fecha, INTERVAL 6 DAY), '%d/%m/%Y') AS fecha_control FROM patient p INNER JOIN recipe r ON p.pid=r.pid WHERE p.pid = $pid");
$userfetch = $userrow->fetch_assoc();

// Asignar los datos del paciente a las variables
$nombrePaciente = $userfetch['pname'];
$rp = $userfetch['descripcion'];
$indicaciones = $userfetch['medicamento'];
$fechaAtencion = $userfetch['fecha'];
$fechaControl = $userfetch['fecha_control'];

// Imprimir el formato

$pdf->SetY(20);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 0, 'PACIENTE: '.$nombrePaciente, 0, 0, 'L');

$pdf->SetY(30);

//include 'formato_indicaciones_medicas.php';//
// Imprimir la fecha de atención
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, utf8_decode('Fecha de Atención: '), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetX(100); //Corre posicion hacia arriba
//$pdf->SetY(50); //Corre posicion hacia abajo
$pdf->Cell(0, 10, $fechaAtencion, 0, 1, 'L');

// Imprimir el RP
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'RP: ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, $rp, 0, 1, 'L');

// Imprimir los medicamentos
$pdf->SetFont('Arial', '', 10);





// Imprimir los medicamentos
while ($row = $userrow->fetch_assoc()) {
    $pdf->SetX(30);
    $indicaciones = $row['medicamento'].' '.$row['descripcion'];
    $pdf->MultiCell(0, 10, utf8_decode($indicaciones), 0, 'L');
}
$pdf->SetX(20);




// Imprimir la fecha de próximo control
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, utf8_decode('Fecha de Próximo Control: '), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->SetX(100);
$pdf->Cell(0, 10, $fechaControl, 0, 1, 'L');

// Imprimir el pie de página
// Posición: a 1,5 cm del final
$pdf->SetY(0);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, utf8_decode('Página ') . $pdf->PageNo() . ' de {nb}', 0, 0, 'R');
//$pdf->Cell(0, 10, utf8_decode('Página ') . $pdf->PageNo() . ' de ' . $pdf->getPageCount(), 0, 0, 'R');
//$pdf->Cell(0, 10, utf8_decode('Página ') . $pdf->PageNo() . ' de ' . $pdf->GetMaxPage(), 0, 0, 'R');

// Cerrar el documento
$pdf->Output();
?>
