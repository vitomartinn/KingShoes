<?php
session_start();
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit();
}
include("conexion.php");
?>
 
<link rel="stylesheet" href="estilos.css">
<h1>👟 King Shoes</h1>
 
<div class="container">
    <h2>Tiendas</h2>
 
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Cliente</th>
        </tr>
 
        <?php
        $sql = "SELECT t.id_tienda, t.nombre_tienda, t.direccion, c.nom_cliente
                FROM tienda t
                JOIN clientes c ON t.id_cliente = c.id_cliente";
 
        $resultado = $conexion->query($sql);
 
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>{$fila['id_tienda']}</td>
                <td>{$fila['nombre_tienda']}</td>
                <td>{$fila['direccion']}</td>
                <td>{$fila['nom_cliente']}</td>
            </tr>";
        }
        ?>
    </table>
 
    <br>
    <a href="index.php" class="secundario">← Volver</a>
</div>