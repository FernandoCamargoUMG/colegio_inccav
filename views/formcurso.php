<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cursos</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body = style="background-color: #6d0d0d">
	<div class="container">
		<h1 class="text-center" style="background-color: #333; color: white">Cursos</h1>
	</div>
	<br>
	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Codigo del curso</th>
					<th scope="col">Curso</th>
					<th  scope="col">Catedratico</th>
					<th scope="col"></th>
					<th scope="col">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php
				require '../config/conexion.php';
				$query = $conn->query("SELECT * FROM curso
				INNER JOIN catedratico ON  curso.id_cat = catedratico.id_cat
				/*INNER JOIN grado ON  alumno.idGrado = grado.id*/
				");
				while ($result = $query->fetch_assoc()) {
					?>
					<tr>
						<th scope="row">
							<?php echo $result['id_curso'] ?>
						</th>
						<th scope="row">
							<?php echo $result['descripcion'] ?>
						</th>
						<th scope="row">
							<?php echo $result['nombre'] ?>
						</th>
						<th  scope="row">
							<?php echo $result['apellido'] ?>
						</th>
						
						<th>
							<a href="../views/editarCurso.php?Id=<?php echo $result['id_curso']?>" class= "btn btn-secondary">Editar</a>
							<a href="../controladores/eliminarCurso.php?Id=<?php echo $result['id_curso']?>" class= "btn btn-danger">Eliminar</a>
						</th>
					</tr>
				<?php
				}
				?>

			</tbody>
		</table>
		<div class="container">
		<a href="../views/agregarCurso.php" class= "btn btn-dark">Agregar</a>
		<a href="../menu_principal.php" class= "btn btn-dark">Volver Atras</a>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
		crossorigin="anonymous"></script>
</body>

</html>