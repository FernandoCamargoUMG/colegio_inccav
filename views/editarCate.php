<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edicion de Catedraticos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete { background: #ffffff; color: #111; border: 1px solid #bfcad6; max-height:240px; overflow-y:auto; box-shadow:0 6px 18px rgba(0,0,0,0.4); z-index:20000!important; }
        .ui-autocomplete .ui-menu-item-wrapper{ padding:6px 12px; }
        .ui-menu-item-wrapper.ui-state-active, .ui-menu-item-wrapper.ui-state-focus{ background:#1f4e79; color:#fff; }
        #estado_texto, #especialidad_texto { background:#fff; color:#111; border-radius:6px; }
    </style>
</head>

<body style="background-color: #6d0d0d">
    <div class="container">
        <h1 class="text-center" style="background-color: #333; color: white">Edicion de Catedraticos</h1>
        <form action="../controladores/editCate.php" method="POST">
            <?php
            include '../config/conexion.php';
            $idParam = isset($_GET['Id']) ? $_GET['Id'] : 0;
            $row = array();
            try {
                $stmt = $conn->prepare("SELECT c.*, e.estado AS estado_nombre, s.descripcion AS especialidad_nombre FROM catedratico c LEFT JOIN colegio.estado_catedra e ON c.estado = e.id_estCate LEFT JOIN colegio.especialidad s ON c.especialidad = s.id_espec WHERE c.id_cat = ?");
            } catch (mysqli_sql_exception $ex) {
                error_log('DB prepare failed (editarCate.php): ' . $ex->getMessage());
                $stmt = false;
            }
            if ($stmt) {
                $stmt->bind_param('i', $idParam);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();
                $stmt->close();
            } else {
                // fallback
                try {
                    $res2 = $conn->query("SELECT * FROM catedratico WHERE id_cat = " . intval($idParam));
                    if ($res2) $row = $res2->fetch_assoc();
                } catch (Exception $e) { error_log('Fallback failed editarCate: '.$e->getMessage()); }
            }
            ?>

            <input type="Hidden" class="form-control" name="Id" value="<?php echo $row['id_cat']; ?>">

            <!--se traen datos grado--->


            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">Carnet(*)</label>
                <input type="text" class="form-control" name="idCate" value="<?php echo $row['id_cat']; ?>">
            </div>
            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">Nombre(*)</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $row['nombre']; ?>">
            </div>
            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">Apellido(*)</label>
                <input type="text" class="form-control" name="apellido" value="<?php echo $row['apellido']; ?>">
            </div>
            <label style="background-color: #6d0d0d; color: white" class="form-label">Seleccione la especialidad(*)</label>
            <br>
            <?php
            $especId = isset($row['especialidad']) ? intval($row['especialidad']) : 0;
            $especText = isset($row['especialidad_nombre']) ? $row['especialidad_nombre'] : '';
            ?>
            <input type="text" id="especialidad_texto" class="form-control mb-2" value="<?php echo htmlspecialchars($especText, ENT_QUOTES); ?>">
            <input type="hidden" name="espec" id="especialidad_id" value="<?php echo $especId > 0 ? $especId : ''; ?>">
            <label style="background-color: #6d0d0d; color: white" class="form-label">Estado del catedrático(*)</label>
            <br>
            <?php
            $estadoId = isset($row['estado']) ? intval($row['estado']) : 0;
            $estadoText = isset($row['estado_nombre']) ? $row['estado_nombre'] : '';
            ?>
            <input type="text" id="estado_texto" class="form-control mb-2" placeholder="Escriba para buscar estado..." value="<?php echo htmlspecialchars($estadoText, ENT_QUOTES); ?>">
            <input type="hidden" name="estado" id="estado" value="<?php echo $estadoId > 0 ? $estadoId : ''; ?>">
            <div class="text-center">
                <button type="submit" class="btn btn-danger">Modificar</button>
                <a href="formcatedratico.php" class="btn btn-dark">Volver Atras</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            // autocomplete para estado_catedra
            $("#estado_texto").autocomplete({
                source: function(request,response){
                    $.ajax({ url: "../controladores/busca_estados.php", type: "POST", dataType: "json", data: { termino: request.term }, success: function(data){ response($.map(data,function(item){ return { label: item.label, value: item.label, id: item.id }; })); } });
                },
                minLength:1,
                select:function(e,ui){ $("#estado").val(ui.item.id); }
            });
            // autocomplete para especialidad (buscar por descripcion)
            $("#especialidad_texto").autocomplete({
                source: function(request,response){
                    $.ajax({ url: "../controladores/busca_especialidad.php", type: "POST", dataType: "json", data: { termino: request.term }, success: function(data){ response($.map(data,function(item){ return { label: item.label, value: item.label, id: item.id }; })); } });
                },
                minLength:1,
                select:function(e,ui){ $("#especialidad_id").val(ui.item.id); }
            });
            // similar manejo blur/submit para resolver si no se selecciona explícitamente
            $("#estado_texto, #especialidad_texto").on('blur', function(){
                var el = $(this);
                var texto = el.val().trim();
                var hid = el.is('#estado_texto')? $('#estado') : $('#especialidad_id');
                var url = el.is('#estado_texto')? '../controladores/busca_estados.php' : '../controladores/busca_especialidad.php';
                if(texto !== '' && (!hid.val() || hid.val() == '')){
                    $.post(url, { termino: texto }, function(data){ if(data && data.length === 1) hid.val(data[0].id); else if(data && data.length>1){ var found=null; for(var i=0;i<data.length;i++){ if(data[i].label.toLowerCase()===texto.toLowerCase()){ found=data[i]; break; } } if(found) hid.val(found.id); } }, 'json');
                }
            });
            $("form").on('submit', function(e){
                var estadoVal = $("#estado").val();
                if(!estadoVal || isNaN(parseInt(estadoVal))){ e.preventDefault(); alert('Por favor seleccione un estado válido desde la lista.'); $('#estado_texto').focus(); return false; }
                return true;
            });
        });
    </script>
</body>

</html>