<?php 
require '../config/conexion.php';

$Id=$_GET['Id'];
$sql = "DELETE FROM catedratico WHERE id_cat = '$Id' ";

$query = mysqli_query($conn, $sql);

if ($query == 1) {
    echo '
				<script language="javascript">
					alert("Registro eliminado correctamente");
					window.location.replace("https://colegioinccav.online/views/formcatedratico.php");
				</script>
			';
    } else {
    echo '
				<script language="javascript">
					alert("Error al  crear el registro");
					window.location.replace("https://colegioinccav.online/views/formcatedratico.php");
				</script>
			';
    }
?>