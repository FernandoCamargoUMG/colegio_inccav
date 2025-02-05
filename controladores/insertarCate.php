<?php
require '../config/conexion.php';

//$idcate = $_POST ['idCate'];
$nombreCA = $_POST['nombre'];
$apellidoCA = $_POST['apellido'];
$especialidadCA = $_POST['espec'];
$estadoCA = $_POST['estado'];

$sql = $conn->prepare("INSERT INTO catedratico (nombre, apellido, especialidad, estado) VALUES (?,?,?,?)");

if (!$sql) {
    die("Error al preparar la consulta: " . $conn->error);
}

$sql->bind_param("ssss", $nombreCA, $apellidoCA, $especialidadCA, $estadoCA);

$resultado = $sql->execute();

$sql->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <script>
        Swal.fire({
            title: "<?php echo $resultado ? 'Éxito' : 'Error'; ?>",
            html: "<?php echo $resultado ? '<strong> Registro agregado correctamente!</strong><br> ¿Desea volver al formulario?'
                        : '<strong>Error al insertar datos:</strong> ' . $conn->error . '<br> ¿Desea volver al formulario?'; ?>",
            icon: "<?php echo $resultado ? 'success' : 'error'; ?>",
            confirmButtonText: "Aceptar",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "../views/formcatedratico.php";
            } else {
                window.history.back();
            }
        });
    </script>
</body>

</html>