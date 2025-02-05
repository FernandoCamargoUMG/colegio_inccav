<?php
require '../config/conexion.php';

if (isset($_GET['Id']) && is_numeric($_GET['Id'])) {
    // Obtener el ID de asignación a eliminar desde la URL
    $id_asig = $_GET['Id'];

    // Eliminar detalles de la asignación de la tabla "asig_det"
    $query_eliminar_det = "DELETE FROM asig_det WHERE id_asig = ?";
    $stmt_eliminar_det = $conn->prepare($query_eliminar_det);
    $stmt_eliminar_det->bind_param("i", $id_asig);
    $stmt_eliminar_det->execute();

    // Eliminar la asignación de la tabla "asignacion"
    $query_eliminar_asig = "DELETE FROM asignacion WHERE id_asig = ?";
    $stmt_eliminar_asig = $conn->prepare($query_eliminar_asig);
    $stmt_eliminar_asig->bind_param("i", $id_asig);
    $stmt_eliminar_asig->execute();

    // Cerrar las consultas preparadas
    $stmt_eliminar_det->close();
    $stmt_eliminar_asig->close();

    echo '
				<script language="javascript">
					alert("Registro actualizado correctamente");
					window.location.replace("../views/formasignacion.php");
				</script>
			';
}else {
    echo '
				<script language="javascript">
					alert("Error al actualizar el registro");
					window.location.replace("../views/formasignacion.php");
				</script>
			';
}
?>



