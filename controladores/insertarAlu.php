<?php
require '../config/conexion.php';

$carnetA = $_POST['carnet'];
$nombreA = $_POST['nombre'];
$apellidoA = $_POST['apellido'];
$descripcionA = $_POST['descripcion'];
$estadoA = $_POST['estado'];

// Preparar la consulta
$sql = $conn->prepare("INSERT INTO alumno (carnet, nombre, apellido, descripcion, estado) VALUES (?,?,?,?,?)");

if (!$sql) {
    die("Error al preparar la consulta: " . $conn->error);
}

$sql->bind_param("issss", $carnetA, $nombreA, $apellidoA, $descripcionA, $estadoA);

// Ejecutar la consulta y mostrar mensaje con SweetAlert
$resultado = $sql->execute();

$sql->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <script>
        Swal.fire({
            title: "<?php echo $resultado ? 'Éxito' : 'Error'; ?>",
            html: "<?php echo $resultado ? '<strong>Registro agregado correctamente!</strong><br>¿Deseas volver al formulario?'
                        : '<strong>Error al insertar datos:</strong> ' . $conn->error . '<br>¿Deseas volver al formulario?'; ?>",
            icon: "<?php echo $resultado ? 'success' : 'error'; ?>",
            confirmButtonText: "Aceptar",
            //showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../views/formalumno.php"; // Redirige después de aceptar
            } else {
                window.history.back(); // Volver a la página anterior si se cancela
            }
        });
    </script>
</body>

</html>