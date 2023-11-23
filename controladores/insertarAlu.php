<?php
require '../config/conexion.php';

    $carnetA = $_POST['carnet'];
    $nombreA = $_POST['nombre'];
    $apellidoA = $_POST['apellido'];
    $descripcionA = $_POST['descripcion'];
    $estadoA = $_POST['estado'];
    

    $query = "insert into colegio_inccav.alumno(carnet, nombre, apellido, descripcion,estado) 
    values('" . $carnetA . "', '" . $nombreA . "', '" . $apellidoA . "', '" . $descripcionA . "', '" . $estadoA . "')";
    $resultado = mysqli_query($conn, $query);
    if ($resultado == 1) {
    echo '
				<script language="javascript">
					alert("Registro creado correctamente");
					window.location.replace("http://localhost/inccav/views/formalumno.php");
				</script>
			';
    } else {
    echo '
				<script language="javascript">
					alert("Error al  crear el registro");
					window.location.replace("http://localhost/inccav/views/formalumno.php");
				</script>
			';
    }