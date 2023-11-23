<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calificaciones Detalle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body style="background-color: #6d0d0d">
    <div class="container">
        <h1 class="text-center" style="background-color: #333; color: white">Calificaciones Detalle</h1>
    </div>
    <br>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Curso Asignado</th>
                    <th scope="col">Nota</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../config/conexion.php';
                $query = $conn->query("SELECT cd.curso, cd.nota, c.descripcion as curso_descripcion
               FROM calificaciones_det cd
               LEFT JOIN curso c ON cd.curso = c.id_curso
               WHERE cd.id_nota =" . $_GET['Id']);

                while ($result = $query->fetch_assoc()) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $result['curso_descripcion'] ?>
                            </td>
                        <th scope="row">
                            <?php echo $result['nota'] ?>
                            </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>


        </table>
        <div class="container">
            <a href="../views/formnota.php" class="btn btn-dark">Volver Atrás para imprimir</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>