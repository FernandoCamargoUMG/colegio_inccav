<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./estilos/estilo_login.css">
		<title>inicio</title>
	</head>
	<body>
	<div class="login" style="text-align: center;">
	<img src="./imagenes/logo.jpg" width="200px" height="200px">
		<h1 class="estilo">Login</h1>
		<form action="validar_conexion.php" method="post" class="login-form">
    	<input type="text" name="user" placeholder="Usuario" required="usuario" />
        <input type="password" name="pass" placeholder="Contraseña" required="password" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
    	</form>
	</div>
	</body>
</html>

