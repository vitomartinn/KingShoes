<?php include("conexion.php"); ?>

<link rel="stylesheet" href="estilos.css">

<h1>👟 King Shoes</h1>

<div class="container">
<h2>Agregar Compra</h2>

<form method="POST">

    Fecha:<br>
    <input type="date" name="fecha" required><br><br>

    Calzado:<br>
    <select name="id_calzado">
        <?php
        $calzados = $conexion->query("SELECT * FROM calzado");
        while ($c = $calzados->fetch_assoc()) {
            echo "<option value='{$c['id_calzado']}'>{$c['modelo']}</option>";
        }
        ?>
    </select><br><br>

    Cantidad:<br>
    <input type="number" name="cantidad" required><br><br>

    <button type="submit">Guardar</button>

</form>

<?php
if ($_POST) {
    $fecha = $_POST['fecha'];
    $id_calzado = $_POST['id_calzado'];
    $cantidad = $_POST['cantidad'];

    $res = $conexion->query("SELECT precio FROM calzado WHERE id_calzado = $id_calzado");
    $dato = $res->fetch_assoc();
    $precio = $dato['precio'];

    $total = $precio * $cantidad;

    $conexion->query("INSERT INTO orden_de_compra (fecha, cantidad, id_calzado, total)
                      VALUES ('$fecha', $cantidad, $id_calzado, $total)");

    echo "<p>✅ Compra agregada correctamente</p>";
}
?>

<br>
<a href="index.php">Volver</a>
</div>