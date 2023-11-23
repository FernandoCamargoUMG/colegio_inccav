<?php
   
   $servername = "142.93.12.121:3306";
    $database = "colegio_inccav";
    $username = "marex";
    $password = "Manager00";

    $conn = new mysqli($servername, $username, $password, $database);
    if (!$conn) {
        echo 'Conexion fallida';
    }

?>