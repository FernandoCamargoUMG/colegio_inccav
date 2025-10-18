<?php
header('Content-Type: application/json; charset=utf-8');
require '../config/conexion.php';

$term = '';
if (isset($_POST['termino'])) {
    $term = trim($_POST['termino']);
}

$out = [];
try {
    if ($term === '') {
        $stmt = $conn->prepare("SELECT id_espec, descripcion FROM especialidad LIMIT 50");
        $stmt->execute();
    } else {
        $like = "%" . $term . "%";
        $stmt = $conn->prepare("SELECT id_espec, descripcion FROM especialidad WHERE descripcion LIKE ? LIMIT 50");
        $stmt->bind_param('s', $like);
        $stmt->execute();
    }
    $res = $stmt->get_result();
    while ($r = $res->fetch_assoc()) {
        $out[] = ['id' => $r['id_espec'], 'label' => $r['descripcion']];
    }
    $stmt->close();
} catch (Exception $e) {
    error_log('busca_especialidad error: ' . $e->getMessage());
}

echo json_encode($out);
exit;
