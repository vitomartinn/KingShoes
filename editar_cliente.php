<?php
session_start();
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit();
}
include("conexion.php");
 
$id = (int) $_GET['id'];
$stmt = $conexion->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$cliente = $stmt->get_result()->fetch_assoc();
$stmt->close();
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = $_POST['num_cliente'];
    $nom = $_POST['nom_cliente'];
    $stmt = $conexion->prepare("UPDATE clientes SET num_cliente=?, nom_cliente=? WHERE id_cliente=?");
    $stmt->bind_param("ssi", $num, $nom, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: clientes.php");
    exit();
}
?>
 
<link rel="stylesheet" href="estilos.css">
<h1>👟 King Shoes</h1>
 
<div class="container">
    <h2>Editar Cliente</h2>
 
    <form method="POST">
        Número de cliente:<br>
        <input type="text" name="num_cliente" value="<?php echo htmlspecialchars($cliente['num_cliente']); ?>" required><br><br>
 
        Nombre:<br>
        <input type="text" name="nom_cliente" value="<?php echo htmlspecialchars($cliente['nom_cliente']); ?>" required><br><br>
 
        <button type="submit">✏️ Guardar cambios</button>
    </form>
 
    <br>
    <a href="clientes.php" class="secundario">← Cancelar</a>
</div>