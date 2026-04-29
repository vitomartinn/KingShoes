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
    <h2>Órdenes de Compra</h2>
 
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Modelo</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
 
        <?php
        $sql = "SELECT o.id_compra, o.fecha, cl.nom_cliente, c.modelo, o.cantidad, o.total
                FROM orden_de_compra o
                JOIN calzado c ON o.id_calzado = c.id_calzado
                JOIN clientes cl ON o.id_cliente = cl.id_cliente";
 
        $resultado = $conexion->query($sql);
 
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>{$fila['id_compra']}</td>
                <td>{$fila['fecha']}</td>
                <td>{$fila['nom_cliente']}</td>
                <td>{$fila['modelo']}</td>
                <td>{$fila['cantidad']}</td>
                <td>$ {$fila['total']}</td>
                <td>
                    <a href='editar_compra.php?id={$fila['id_compra']}'>✏️ Editar</a>
                    <a href='eliminar_compra.php?id={$fila['id_compra']}'
                       onclick=\"return confirm('¿Seguro que querés eliminar esta orden?')\">❌ Eliminar</a>
                </td>
            </tr>";
        }
        ?>
    </table>
 
    <br>
    <a href="agregar_compra.php">➕ Agregar Compra</a>
    <a href="index.php" class="secundario">← Volver</a>
</div>