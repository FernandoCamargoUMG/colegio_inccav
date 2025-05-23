<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Catedratico</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body = style="background-color: #6d0d0d">
	<div class="container">
		<h1 class="text-center" style="background-color: #333; color: white">Listado de Catedraticos</h1>
	</div>
	<br>
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<!-- <th scope="col">ID</th> -->
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Especialidad</th>
					<th scope="col">Estado</th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				require '../config/conexion.php';
				$query = $conn->query("SELECT * FROM catedratico
				INNER JOIN estado_catedra ON  catedratico.estado = estado_catedra.id_estCate
				INNER JOIN especialidad ON  catedratico.especialidad = especialidad.id_espec
				");
				while ($result = $query->fetch_assoc()) {
					?>
					<tr>
						<!-- <th scope="row">
							<?php //echo $result['id_cat'] ?>
						</th> -->
						<th scope="row">
							<?php echo $result['nombre'] ?>
						</th>
						<th scope="row">
							<?php echo $result['apellido'] ?>
						</th>
						<th scope="row">
							<?php echo $result['descripcion'] ?>
						</th>
						<th scope="row">
							<?php echo $result['estado'] ?>
						</th>
						<th>
							<a href="../views/editarCate.php?Id=<?php echo $result['id_cat']?>" class= "btn btn-secondary">Editar</a>
							<a href="../controladores/eliminarCate.php?Id=<?php echo $result['id_cat']?>" class= "btn btn-danger">Eliminar</a>
						</th>
					</tr>
				<?php
				}
				
				?>	
			</tbody>
		</table>
		<div class="container">
		<a href="../views/agregarCate.php" class= "btn btn-dark">Agregar</a>
		<a href="../menu_principal.php" class= "btn btn-dark">Volver Atras</a>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
		crossorigin="anonymous"></script>
</body>

</html>