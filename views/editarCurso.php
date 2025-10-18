<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar curso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-autocomplete { background:#fff; color:#111; border:1px solid #bfcad6; max-height:240px; overflow-y:auto; box-shadow:0 6px 18px rgba(0,0,0,0.4); z-index:20000!important; }
        .ui-autocomplete .ui-menu-item-wrapper{ padding:6px 12px; }
        .ui-menu-item-wrapper.ui-state-active, .ui-menu-item-wrapper.ui-state-focus{ background:#1f4e79; color:#fff; }
        #catedratico{ background:#fff; color:#111; border-radius:6px; }
    </style>
</head>

<body style="background-color: #6d0d0d">
    <div class="container">
        <h1 class="text-center" style="background-color: #333; color: white">Edicion de alumnos</h1>
        <form action="../controladores/editCurso.php" method="POST">
            <?php
            include '../config/conexion.php';
            $idParam = isset($_GET['Id']) ? $_GET['Id'] : 0;
            $row = array();
            try {
                $stmt = $conn->prepare("SELECT cu.*, CONCAT(ca.nombre,' ',ca.apellido) AS catedratico_nombre FROM curso cu LEFT JOIN catedratico ca ON cu.id_cat = ca.id_cat WHERE cu.id_curso = ?");
            } catch (mysqli_sql_exception $ex) { error_log('DB prepare failed (editarCurso.php): '.$ex->getMessage()); $stmt = false; }
            if($stmt){
                $stmt->bind_param('i', $idParam);
                $stmt->execute();
                $res = $stmt->get_result();
                $row = $res->fetch_assoc();
                $stmt->close();
            } else {
                try{ $res2 = $conn->query("SELECT * FROM curso WHERE id_curso = " . intval($idParam)); if($res2) $row = $res2->fetch_assoc(); } catch(Exception $e){ error_log('Fallback editarCurso: '.$e->getMessage()); }
            }
            ?>

            <input type="Hidden" class="form-control" name="Id" value="<?php echo $row['id_curso']; ?>">

            <!--se traen datos grado--->


            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">ID del curso(*)</label>
                <input type="text" class="form-control" name="idCurso" value="<?php echo $row['id_curso']; ?>">
            </div>
            <div class="mb-3">
                <label style="background-color: #6d0d0d; color: white" class="form-label">Nombre del curso(*)</label>
                <input type="text" class="form-control" name="nombreCurso" value="<?php echo $row['descripcion']; ?>">
            </div>
            <label style="background-color: #6d0d0d; color: white" class="form-label">Catedratico que lo imparte(*)</label>
            <br>
            <?php
            $catId = isset($row['id_cat']) ? intval($row['id_cat']) : 0;
            $catText = isset($row['catedratico_nombre']) ? $row['catedratico_nombre'] : '';
            ?>
            <input type="text" id="catedratico" class="form-control mb-2" placeholder="Escriba para buscar catedrático..." value="<?php echo htmlspecialchars($catText, ENT_QUOTES); ?>">
            <input type="hidden" name="id_cat" id="catedratico_id" value="<?php echo $catId>0?$catId:''; ?>">
            <div class="text-center">
                <button type="submit" class="btn btn-danger">Modificar</button>
                <a href="formcurso.php" class="btn btn-dark">Volver Atras</a>
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
            $("#catedratico").autocomplete({
                source: function(request,response){
                    $.ajax({ url: "../controladores/busca_catedratico.php", type: "POST", dataType: "json", data: { termino: request.term }, success: function(data){ response($.map(data,function(item){ return { label: item.label, value: item.label, id: item.id }; })); } });
                }, minLength:1, select:function(e,ui){ $("#catedratico_id").val(ui.item.id); }
            });
            $("#catedratico").on('blur', function(){ var texto=$(this).val().trim(); var hid=$("#catedratico_id"); if(texto!=='' && (!hid.val() || hid.val()=='')){ $.post('../controladores/busca_catedratico.php', { termino:texto }, function(data){ if(data&&data.length===1) hid.val(data[0].id); else if(data&&data.length>1){ var f=null; for(var i=0;i<data.length;i++){ if(data[i].label.toLowerCase()===texto.toLowerCase()){ f=data[i]; break; } } if(f) hid.val(f.id); } }, 'json'); } });
            $("form").on('submit', function(e){ var hid=$("#catedratico_id").val(); if(!hid||isNaN(parseInt(hid))){ e.preventDefault(); alert('Por favor seleccione un catedrático válido.'); $('#catedratico').focus(); return false; } return true; });
        });
    </script>
</body>

</html>