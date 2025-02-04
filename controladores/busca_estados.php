<?php
require '../config/conexion.php';

$termino = $_POST['termino'];

$sql = $conn->prepare("SELECT estado FROM colegio_inccav.estado_alu WHERE estado LIKE ?");
$likeTermino = "%" . $termino . "%";
$sql->bind_param("s", $likeTermino);
$sql->execute();
$resultado = $sql->get_result();

$estados = [];
while ($fila = $resultado->fetch_assoc()) {
    $estados[] = $fila['estado'];
}

echo json_encode($estados);

$sql->close();
$conn->close();
?>
