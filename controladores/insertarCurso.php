<?php
require '../config/conexion.php';

    $nombrecurso = $_POST['nombreCurso'];
    $idCatC = $_POST['idCat'];
    

    $query = "insert into colegio_inccav.curso(descripcion, id_Cat) 
    values('" . $nombrecurso . "', '" . $idCatC . "')";
    $resultado = mysqli_query($conn, $query);
    if ($resultado == 1) {
    echo '
				<script language="javascript">
					alert("Registro creado correctamente");
					window.location.replace("https://colegioinccav.online/views/formcurso.php");
				</script>
			';
    } else {
    echo '
				<script language="javascript">
					alert("Error al  crear el registro");
					window.location.replace("https://colegioinccav.online/views/formcurso.php");
				</script>
			';
    }