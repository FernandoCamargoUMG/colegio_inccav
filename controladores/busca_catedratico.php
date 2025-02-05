<?php
require '../config/conexion.php';

$termino = $_POST['termino'];

$sql = $conn->prepare("SELECT id_cat, nombre, apellido FROM catedratico WHERE nombre LIKE ? OR apellido LIKE ?");
$likeTermino = "%" . $termino . "%";
$sql->bind_param("ss", $likeTermino, $likeTermino);
$sql->execute();
$resultado = $sql->get_result();

$catedraticos = [];
while ($fila = $resultado->fetch_assoc()) {
    $catedraticos[] = [
        'id_cat' => $fila['id_cat'],
        'nombre' => $fila['nombre'],
        'apellido' => $fila['apellido']
    ];
}

echo json_encode($catedraticos);

$sql->close();
$conn->close();
?>
