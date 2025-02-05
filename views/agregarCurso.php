<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body style="background-color: #6d0d0d">
    <h1 class="bg-black p-2 text-white text-center">Crear curso</h1>
    <br>
    <div class="container">
        <form action="../controladores/insertarCurso.php" method="POST">
            <div class="mb-3">
                <label class="form-label text-white">Nombre del curso(*)</label>
                <input type="text" class="form-control" name="nombreCurso" required>
            </div>

            <label class="form-label text-white">Catedrático que lo imparte(*)</label>
            <input type="text" class="form-control" id="catedratico" required>
            <input type="hidden" name="idCat" id="idCat">

            <div class="text-center mt-3">
                <button type="submit" class="btn btn-danger">Registrar</button>
                <a href="formcurso.php" class="btn btn-dark">Volver Atrás</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#catedratico").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "../controladores/busca_catedratico.php",
                        type: "POST",
                        dataType: "json",
                        data: {
                            termino: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.nombre + " " + item.apellido,
                                    value: item.nombre + " " + item.apellido,
                                    id: item.id_cat
                                };
                            }));
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    $("#idCat").val(ui.item.id);
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>