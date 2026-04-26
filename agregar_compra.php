Reemplazá el contenido de index.php con esto:
php<?php
// error_reporting(E_ALL);       // Solo activar en desarrollo
// ini_set('display_errors', 1); // Solo activar en desarrollo
?>

<link rel="stylesheet" href="estilos.css">

<h1>👟 King Shoes</h1>

<div class="container">
    <h2>Panel de Administración</h2>

    <a href="clientes.php">Clientes</a>
    <a href="calzado.php">Calzado</a>
    <a href="compras.php">Compras</a>
    <a href="agregar_compra.php">Agregar Compra</a>
    <a href="tiendas.php">Tiendas</a>
</div>

3. agregar_compra.php — prepared statements + selector de cliente
Reemplazá el archivo completo con esto:
php<?php include("conexion.php"); ?>

<link rel="stylesheet" href="estilos.css">

<h1>👟 King Shoes</h1>

<div class="container">
<h2>Agregar Compra</h2>

<form method="POST">

    Fecha:<br>
    <input type="date" name="fecha" required><br><br>

    Cliente:<br>
    <select name="id_cliente">
        <?php
        $clientes = $conexion->query("SELECT * FROM clientes");
        while ($cl = $clientes->fetch_assoc()) {
            echo "<option value='{$cl['id_cliente']}'>{$cl['nom_cliente']}</option>";
        }
        ?>
    </select><br><br>

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
    <input type="number" name="cantidad" min="1" required><br><br>

    <button type="submit">Guardar</button>

</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha      = $_POST['fecha'];
    $id_calzado = (int) $_POST['id_calzado'];
    $id_cliente = (int) $_POST['id_cliente'];
    $cantidad   = (int) $_POST['cantidad'];

    // Obtener precio con prepared statement
    $stmt = $conexion->prepare("SELECT precio FROM calzado WHERE id_calzado = ?");
    $stmt->bind_param("i", $id_calzado);
    $stmt->execute();
    $res = $stmt->get_result();
    $dato = $res->fetch_assoc();
    $stmt->close();

    $total = $dato['precio'] * $cantidad;

    // Insertar con prepared statement
    $stmt = $conexion->prepare("INSERT INTO orden_de_compra (fecha, cantidad, id_calzado, id_cliente, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiid", $fecha, $cantidad, $id_calzado, $id_cliente, $total);
    $stmt->execute();
    $stmt->close();

    echo "<p>✅ Compra agregada correctamente</p>";
}
?>

<br>
<a href="index.php">Volver</a>
</div>
