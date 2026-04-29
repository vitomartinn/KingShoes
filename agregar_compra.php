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
                echo "<option value='{$c['id_calzado']}'>{$c['modelo']} — $ {$c['precio']}</option>";
            }
            ?>
        </select><br><br>
 
        Cantidad:<br>
        <input type="number" name="cantidad" min="1" required><br><br>
 
        <button type="submit">✅ Guardar</button>
 
    </form>
 
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha      = $_POST['fecha'];
        $id_calzado = (int) $_POST['id_calzado'];
        $id_cliente = (int) $_POST['id_cliente'];
        $cantidad   = (int) $_POST['cantidad'];
 
        $stmt = $conexion->prepare("SELECT precio FROM calzado WHERE id_calzado = ?");
        $stmt->bind_param("i", $id_calzado);
        $stmt->execute();
        $dato  = $stmt->get_result()->fetch_assoc();
        $stmt->close();
 
        $total = $dato['precio'] * $cantidad;
 
        $stmt = $conexion->prepare("INSERT INTO orden_de_compra (fecha, cantidad, id_calzado, id_cliente, total) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiid", $fecha, $cantidad, $id_calzado, $id_cliente, $total);
        $stmt->execute();
        $stmt->close();
 
        echo "<p>✅ Compra agregada correctamente. Total: $ $total</p>";
    }
    ?>
 
    <br>
    <a href="compras.php" class="secundario">← Volver</a>
</div>