<?php
session_start();
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit();
}
include("conexion.php");
 
$busqueda = "";
if (!empty($_GET['buscar'])) {
    $busqueda = $_GET['buscar'];
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE nom_cliente LIKE ?");
    $like = "%$busqueda%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    $resultado = $conexion->query("SELECT * FROM clientes");
}
?>
 
<link rel="stylesheet" href="estilos.css">
<h1>👟 King Shoes</h1>
 
<div class="container">
    <h2>Clientes</h2>
 
    <form method="GET">
        <input type="text" name="buscar" placeholder="Buscar por nombre..." value="<?php echo htmlspecialchars($busqueda); ?>">
        <button type="submit">🔍 Buscar</button>
        <a href="clientes.php" class="secundario">Ver todos</a>
    </form>
 
    <table>
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
 
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $fila['id_cliente']; ?></td>
            <td><?php echo htmlspecialchars($fila['num_cliente']); ?></td>
            <td><?php echo htmlspecialchars($fila['nom_cliente']); ?></td>
            <td>
                <a href="editar_cliente.php?id=<?php echo $fila['id_cliente']; ?>">✏️ Editar</a>
                <a href="eliminar_cliente.php?id=<?php echo $fila['id_cliente']; ?>"
                   onclick="return confirm('¿Seguro que querés eliminar a <?php echo htmlspecialchars($fila['nom_cliente']); ?>?')">❌ Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
 
    <br>
    <a href="index.php" class="secundario">← Volver</a>
</div>