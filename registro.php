<?php
session_start();
include("conexion.php");
 
$mensaje = "";
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num  = $_POST['num_cliente'];
    $nom  = $_POST['nom_cliente'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
 
    $stmt = $conexion->prepare("SELECT id_cliente FROM clientes WHERE num_cliente = ?");
    $stmt->bind_param("s", $num);
    $stmt->execute();
    $stmt->store_result();
 
    if ($stmt->num_rows > 0) {
        $mensaje = "❌ Ese número de cliente ya existe.";
        $stmt->close();
    } else {
        $stmt->close();
        $stmt = $conexion->prepare("INSERT INTO clientes (num_cliente, nom_cliente, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $num, $nom, $pass);
        $stmt->execute();
        $stmt->close();
        $mensaje = "✅ Cuenta creada correctamente.";
    }
}
?>
 
<link rel="stylesheet" href="estilos.css">
<h1>👟 King Shoes</h1>
 
<div class="container">
    <h2>Registrarse</h2>
 
    <?php if ($mensaje) echo "<p>$mensaje</p>"; ?>
 
    <form method="POST">
        Número de cliente:<br>
        <input type="text" name="num_cliente" required><br><br>
 
        Nombre completo:<br>
        <input type="text" name="nom_cliente" required><br><br>
 
        Contraseña:<br>
        <input type="password" name="password" required><br><br>
 
        <button type="submit">Registrarse</button>
    </form>
 
    <br>
    <a href="login.php" class="secundario">¿Ya tenés cuenta? Iniciá sesión</a>
</div>