<?php
   
   $servername = "localhost";
    $database = "colegio_inccav";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password, $database);
    if (!$conn) {
        echo 'Conexion fallida';
    }

    $conn->set_charset('utf8mb4');
?>