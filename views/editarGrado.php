<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar grados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body style="background-color: #6d0d0d">
    <div class="container">
        <h1 class="text-center" style="background-color: #333; color: white">Edicion de grados </h1>
        <form action="../controladores/editGrado.php" method="POST">
            <?php
            include '../config/conexion.php';
            $sql = "SELECT * FROM grado WHERE id =" . $_GET['Id'];
            $resultado = $conn->query($sql);

            $row = $resultado->fetch_assoc();
            ?>

            <input type="Hidden" class="form-control" name="Id" value="<?php echo $row['id']; ?>">

            <!--se traen datos grado--->

            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="grado" value="<?php echo $row['grado']; ?>">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger">Modificar</button>
                <a href="formgrados.php" class="btn btn-dark">Volver Atras</a>
        </div>
        </form>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>