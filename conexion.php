<?php
$conexion = new mysqli("localhost", "root", "", "king_shoes");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>