<?php
require '../config/conexion.php';
require('../library/fpdf.php');

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Cobros', 0, 1, 'C');
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear el objeto PDF
$pdf = new PDF();
$pdf->AddPage();

// Verificar si se proporciona el parámetro 'Id' en la URL
if (isset($_GET['Id'])) {
    // Obtener el ID desde la URL
    $idPago = $_GET['Id'];

    // Consultar la base de datos con el ID específico
    $query = $conn->prepare("SELECT cd.id_tran, cd.id_pago, cd.descripcion, cd.monto, c.carnet, c.fecha
                             FROM cobros_det cd
                             JOIN cobros c ON cd.id_pago = c.idPago
                             WHERE c.idPago = ?");
    $query->bind_param("i", $idPago);
    $query->execute();
    $result = $query->get_result();

    // Encabezados de la tabla en el PDF
    $pdf->SetXY(50,20);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(70, 10, 'Descripcion', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Monto', 1, 1, 'C');

    // Establecer la posición X para la primera celda
    $pdf->SetX(50);

    // Contenido de la tabla en el PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(70, 10, $row['descripcion'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['monto'], 1, 1, 'C');
    }

    // Salida del PDF
    $pdf->Output();
} else {
    // Si no se proporciona el parámetro 'Id', mostrar un mensaje de error o redirigir a otra página.
    echo "ID no proporcionado.";
}
?>
