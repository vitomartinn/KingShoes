<?php include("conexion.php"); ?>

<link rel="stylesheet" href="estilos.css">

<h1>👟 King Shoes</h1>

<div class="container">
<h2>Órdenes de Compra</h2>

<table>
<tr>
    <th>ID</th>
    <th>Fecha</th>
    <th>Modelo</th>
    <th>Cantidad</th>
    <th>Total</th>
</tr>

<?php
$sql = "SELECT o.id_compra, o.fecha, c.modelo, o.cantidad, o.total
        FROM orden_de_compra o
        JOIN calzado c ON o.id_calzado = c.id_calzado";

$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
        <td>{$fila['id_compra']}</td>
        <td>{$fila['fecha']}</td>
        <td>{$fila['modelo']}</td>
        <td>{$fila['cantidad']}</td>
        <td>{$fila['total']}</td>
    </tr>";
}
?>
</table>

<br>
<a href="index.php">Volver</a>
</div>