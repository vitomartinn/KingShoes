<?php include("conexion.php"); ?>

<link rel="stylesheet" href="estilos.css">

<h1>👟 King Shoes</h1>

<div class="container">
<h2>Clientes</h2>

<table>
<tr>
    <th>ID</th>
    <th>Número</th>
    <th>Nombre</th>
</tr>

<?php
$resultado = $conexion->query("SELECT * FROM clientes");

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>
        <td>{$fila['id_cliente']}</td>
        <td>{$fila['num_cliente']}</td>
        <td>{$fila['nom_cliente']}</td>
    </tr>";
}
?>
</table>

<br>
<a href="index.php">Volver</a>
</div>