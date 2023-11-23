<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cobros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body style="background-color: #6d0d0d">
    <h1 class="bg-black p-2 text-white text-center">Cobros</h1>
    <br>
    <div class="container">
        <form action="../controladores/insertarPago.php" method="POST">
        <select class="form-select mb-3" name="carnet" >
                <option selected disabled>---seleccionar alumno---</option>
                <?php
                include '../config/conexion.php';
                $sql = $conn->query("SELECT * FROM colegio_inccav.alumno;");
                while ($resultado = $sql->fetch_assoc()) {
                    echo "<option value='" . $resultado['carnet'] . "'>" . $resultado['nombre'] . " " . $resultado['apellido'] . "</option>";
                }
                ?>
            </select>
            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha">
            </div>
            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="descripcion">
            </div>
            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">Monto a pagar</label>
                <input type="text" class="form-control" name="monto">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger">Registrar</button>
                <a href="../views/formcobros.php" class="btn btn-dark">Volver Atras</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>