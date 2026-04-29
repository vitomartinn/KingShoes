<?php
session_start();
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit();
}
include("conexion.php");
 
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $stmt = $conexion->prepare("DELETE FROM orden_de_compra WHERE id_compra = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
 
header("Location: compras.php");
exit();
?>