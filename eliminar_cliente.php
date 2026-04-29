<?php
session_start();
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit();
}
include("conexion.php");
 
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $conexion->prepare("DELETE FROM clientes WHERE id_cliente = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
 
header("Location: clientes.php");
exit();
?>