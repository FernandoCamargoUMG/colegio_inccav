<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalles de pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body style="background-color: #6d0d0d">
    <div class="container">
        <h1 class="text-center" style="background-color: #333; color: white">Detalles de pago</h1>
    </div>
    <br>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">descripción</th>
                    <th scope="col">Monto pagado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require '../config/conexion.php';

                // Cambia la consulta para incluir la información de la tabla curso
                $query = $conn->query("SELECT cd.id_tran, cd.id_pago, cd.descripcion, cd.monto, c.carnet, c.fecha
                           FROM cobros_det cd
                           JOIN cobros c ON cd.id_pago = c.idPago
                           WHERE c.idPago =" . $_GET['Id']);
                while ($result = $query->fetch_assoc()) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php echo $result['descripcion'] ?>
                        </th>
                        <th scope="row">
                            <?php echo $result['monto'] ?>
                        </th>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="container">
            <a href="../views/formcobros.php" class="btn btn-dark">Volver Atras</a>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>