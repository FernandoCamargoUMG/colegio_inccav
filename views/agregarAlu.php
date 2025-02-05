<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body style="background-color: #6d0d0d">
    <h1 class="bg-black p-2 text-white text-center">Agregar Alumno</h1>
    <br>
    <div class="container">
        <form action="../controladores/insertarAlu.php" method="POST">
            <div class="mb-3">
                <label class="form-label text-white">Ingrese el Carnet(*)</label>
                <input type="text" class="form-control" name="carnet">
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Ingrese el Nombre(*)</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Ingrese el Apellido(*)</label>
                <input type="text" class="form-control" name="apellido">
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Observaciones(*)</label>
                <input type="text" class="form-control" name="descripcion">
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Estado del estudiante(*)</label>
                <input type="text" class="form-control" id="estado" name="estado">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-danger">Registrar</button>
                <a href="formalumno.php" class="btn btn-dark">Volver Atrás</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#estado").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "../controladores/busca_estados.php",
                        type: "POST",
                        dataType: "json",
                        data: { termino: request.term },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                minLength: 1
            });
        });
    </script>
</body>

</html>
