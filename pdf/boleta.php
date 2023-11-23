<?php
require '../config/conexion.php';
require('../library/fpdf.php');

class PDF extends FPDF
{
    // Encabezado
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Notas', 0, 1, 'C');
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
    $idNota = $_GET['Id'];

    // Consultar la base de datos con el ID específico
    $query = $conn->prepare("SELECT cd.curso, cd.nota, c.descripcion as curso_descripcion
                             FROM calificaciones_det cd
                             LEFT JOIN curso c ON cd.curso = c.id_curso
                             WHERE cd.id_nota = ?");
    $query->bind_param("i", $idNota);
    $query->execute();
    $result = $query->get_result();

    // Contenido de la tabla en el PDF
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(70, 10, $row['curso_descripcion'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['nota'], 1, 1, 'C');
    }

    // Salida del PDF
    $pdf->Output();
} else {
    // Si no se proporciona el parámetro 'Id', mostrar un mensaje de error o redirigir a otra página.
    echo "ID no proporcionado.";
}
?>


















