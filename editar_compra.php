<?php
session_start();
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit();
}
include("conexion.php");
 
$id = (int) $_GET['id'];
$stmt = $conexion->prepare("SELECT * FROM orden_de_compra WHERE id_compra = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$orden = $stmt->get_result()->fetch_assoc();
$stmt->close();
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha      = $_POST['fecha'];
    $id_calzado = (int) $_POST['id_calzado'];
    $id_cliente = (int) $_POST['id_cliente'];
    $cantidad   = (int) $_POST['cantidad'];
 
    $stmt = $conexion->prepare("SELECT precio FROM calzado WHERE id_calzado = ?");
    $stmt->bind_param("i", $id_calzado);
    $stmt->execute();
    $precio = $stmt->get_result()->fetch_assoc()['precio'];
    $stmt->close();
 
    $total = $precio * $cantidad;
 
    $stmt = $conexion->prepare("UPDATE orden_de_compra SET fecha=?, id_calzado=?, id_cliente=?, cantidad=?, total=? WHERE id_compra=?");
    $stmt->bind_param("siiidi", $fecha, $id_calzado, $id_cliente, $cantidad, $total, $id);
    $stmt->execute();
    $stmt->close();
 
    header("Location: compras.php");
    exit();
}
?>
 
<link rel="stylesheet" href="estilos.css">
<h1>👟 King Shoes</h1>
 
<div class="container">
    <h2>Editar Orden #<?php echo $id; ?></h2>
 
    <form method="POST">
 
        Fecha:<br>
        <input type="date" name="fecha" value="<?php echo $orden['fecha']; ?>" required><br><br>
 
        Cliente:<br>
        <select name="id_cliente">
            <?php
            $clientes = $conexion->query("SELECT * FROM clientes");
            while ($cl = $clientes->fetch_assoc()) {
                $sel = $cl['id_cliente'] == $orden['id_cliente'] ? 'selected' : '';
                echo "<option value='{$cl['id_cliente']}' $sel>{$cl['nom_cliente']}</option>";
            }
            ?>
        </select><br><br>
 
        Calzado:<br>
        <select name="id_calzado">
            <?php
            $calzados = $conexion->query("SELECT * FROM calzado");
            while ($c = $calzados->fetch_assoc()) {
                $sel = $c['id_calzado'] == $orden['id_calzado'] ? 'selected' : '';
                echo "<option value='{$c['id_calzado']}' $sel>{$c['modelo']} — $ {$c['precio']}</option>";
            }
            ?>
        </select><br><br>
 
        Cantidad:<br>
        <input type="number" name="cantidad" value="<?php echo $orden['cantidad']; ?>" min="1" required><br><br>
 
        <button type="submit">✏️ Guardar cambios</button>
 
    </form>
 
    <br>
    <a href="compras.php" class="secundario">← Cancelar</a>
</div>