<?php
session_start();
if (!isset($_SESSION['cliente'])) {
    header("Location: login.php");
    exit();
}
?>
 
<link rel="stylesheet" href="estilos.css">
<h1>👟 King Shoes</h1>
 
<div class="container">
    <h2>Panel de Administración</h2>
    <p style="background:none; border:none; color:#aaa; padding: 0 0 20px 0;">
        Bienvenido, <?php echo htmlspecialchars($_SESSION['cliente']); ?> 👋
    </p>
 
    <div class="panel-links">
        <a href="clientes.php">👥 Clientes</a>
        <a href="calzado.php">👟 Calzado</a>
        <a href="compras.php">🧾 Compras</a>
        <a href="agregar_compra.php">➕ Agregar Compra</a>
        <a href="tiendas.php">🏪 Tiendas</a>
        <a href="logout.php" class="danger">🚪 Cerrar sesión</a>
    </div>
</div>