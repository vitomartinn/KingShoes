<?php include("conexion.php"); ?>

<link rel="stylesheet" href="estilos.css">

<h1>👟 King Shoes</h1>

<div class="container">
<h2>Calzado</h2>

<table>
<tr>
    <th>ID</th>
    <th>Modelo</th>
    <th>Talle</th>
    <th>Precio</th>
    <th>Stock</th>
</tr>

<?php
$resultado = $conexion->query("SELECT * FROM calzado");

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
        <td>{$fila['id_calzado']}</td>
        <td>{$fila['modelo']}</td>
        <td>{$fila['talle']}</td>
        <td>{$fila['precio']}</td>
        <td>{$fila['stock']}</td>
    </tr>";
}
?>
</table>

<br>
<a href="index.php">Volver</a>
</div>