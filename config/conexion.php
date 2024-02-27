<?php
   
   $servername = "localhost";
    $database = "colegio_inccav";
    $username = "root";
    $password = "admin";

    $conn = new mysqli($servername, $username, $password, $database);
    if (!$conn) {
        echo 'Conexion fallida';
    }

?>