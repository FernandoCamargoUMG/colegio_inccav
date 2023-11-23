<?php 
require '../config/conexion.php';

$Id=$_GET['Id'];
$sql = "DELETE FROM grado WHERE id = '$Id' ";

$query = mysqli_query($conn, $sql);

if ($query == 1) {
    echo '
				<script language="javascript">
					alert("Registro eliminado correctamente");
					window.location.replace("http://localhost/inccav/views/formgrados.php");
				</script>
			';
    } else {
    echo '
				<script language="javascript">
					alert("Error al eliminar registro");
					window.location.replace("http://localhost/inccav/views/formgrados.php");
				</script>
			';
    }
?>