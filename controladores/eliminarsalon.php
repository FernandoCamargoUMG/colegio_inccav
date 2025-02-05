<?php 
require '../config/conexion.php';

$Id=$_GET['Id'];
$sql = "DELETE FROM salon WHERE no_salon = '$Id' ";

$query = mysqli_query($conn, $sql);

if ($query == 1) {
    echo '
				<script language="javascript">
					alert("Registro eliminado correctamente");
					window.location.replace("../views/formsalon.php");
				</script>
			';
    } else {
    echo '
				<script language="javascript">
					alert("Error al eliminar registro");
					window.location.replace("../views/formsalon.php");
				</script>
			';
    }
?>