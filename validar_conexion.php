<?php
require 'config/conexion.php';

// Capturar y sanitizar los datos enviados por POST
$usuario = mysqli_real_escape_string($conn, $_POST['user']);
$password = $_POST['pass'];

// Encriptar la contraseña usando MD5
$password_encriptada = md5($password);

// Preparar la consulta para evitar inyección SQL
$query = "SELECT * FROM colegio_inccav.usuario WHERE nombre_usuario = ? AND clave = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $usuario, $password_encriptada);
$stmt->execute();
$resultado = $stmt->get_result();

// Comprobar si hay resultados
if ($resultado->num_rows > 0) {
    // Redirigir al menú principal si la autenticación es exitosa
   // Si la validación es exitosa, devolver 'success'
	echo 'success';
} else {
    // Si no, devolver un mensaje de error
    echo 'error';
}

$stmt->close();
$conn->close();
?>
