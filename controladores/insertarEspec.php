<?php
require '../config/conexion.php';

    $idespec = $_POST['IdEspec'];
    $Desc = $_POST['desc'];
    

    $query = "insert into colegio_inccav.especialidad(id_espec, descripcion) 
    values('" . $idespec . "', '" . $Desc . "')";
    $resultado = mysqli_query($conn, $query);
    if ($resultado == 1) {
    echo '
				<script language="javascript">
					alert("Registro creado correctamente");
					window.location.replace("https://colegioinccav.online/views/especialidades.php");
				</script>
			';
    } else {
    echo '
				<script language="javascript">
					alert("Error al  crear el registro");
					window.location.replace("https://colegioinccav.online/views/especialidades.php");
				</script>
			';
    }