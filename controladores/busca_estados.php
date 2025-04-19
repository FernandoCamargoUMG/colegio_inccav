<?php
require '../config/conexion.php';

$termino = $_POST['termino'];

$sql = $conn->prepare("SELECT id_estAlu, estado FROM estado_alu WHERE estado LIKE ?");
$likeTerm = "%$termino%";
$sql->bind_param("s", $likeTerm);
$sql->execute();
$result = $sql->get_result();

$estados = [];

while ($row = $result->fetch_assoc()) {
    $estados[] = [
        "label" => $row['estado'],
        "id" => $row['id_estAlu']
    ];
}

echo json_encode($estados);
?>
