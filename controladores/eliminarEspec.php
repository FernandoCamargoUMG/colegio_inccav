<?php 
require '../config/conexion.php';

$Id=$_GET['Id'];
$sql = "DELETE FROM especialidad WHERE id_espec = '$Id' ";

$query = mysqli_query($conn, $sql);

if ($query == 1) {
    echo '
				<script language="javascript">
					alert("Registro eliminado correctamente");
					window.location.replace("../views/especialidades.php");
				</script>
			';
    } else {
    echo '
				<script language="javascript">
					alert("Error al eliminar registro");
					window.location.replace("../views/especialidades.php");
				</script>
			';
    }
?>