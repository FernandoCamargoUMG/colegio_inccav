<?php
	require 'config/conexion.php';

	$usuario = $_POST['user'];
	$password = $_POST['pass'];

	$query = "select * from colegio_inccav.usuario where nombre_usuario = '".$usuario."' and clave = '".$password."'";
	$resultado = mysqli_query($conn, $query);
	if(mysqli_num_rows($resultado) > 0){
		header("refresh: 2; menu_principal.php");
	} else{
		header("refresh: 2; index.php");
	}
?>