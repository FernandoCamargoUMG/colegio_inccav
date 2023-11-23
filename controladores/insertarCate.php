<?php
require '../config/conexion.php';

    $idcate = $_POST['idCate'];
    $nombreCA = $_POST['nombre'];
    $apellidoCA = $_POST['apellido'];
    $especialidadCA = $_POST['espec'];
    $estadoCA = $_POST['estado'];
    

    $query = "insert into colegio_inccav.catedratico(nombre, apellido, especialidad, estado) 
    values('" . $nombreCA . "', '" . $apellidoCA . "', '" . $especialidadCA . "', '" . $estadoCA . "')";
    $resultado = mysqli_query($conn, $query);
    if ($resultado == 1) {
    echo '
				<script language="javascript">
					alert("Registro creado correctamente");
					window.location.replace("http://localhost/inccav/views/formcatedratico.php");
				</script>
			';
    } else {
    echo '
				<script language="javascript">
					alert("Error al  crear el registro");
					window.location.replace("http://localhost/inccav/views/formcatedratico.php");
				</script>
			';
    }