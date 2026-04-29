<?php
session_start();
include("conexion.php");
 
$error = "";
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num  = $_POST['num_cliente'];
    $pass = $_POST['password'];
 
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE num_cliente = ?");
    $stmt->bind_param("s", $num);
    $stmt->execute();
    $res     = $stmt->get_result();
    $cliente = $res->fetch_assoc();
    $stmt->close();
 
    if ($cliente && password_verify($pass, $cliente['password'])) {
        $_SESSION['cliente']    = $cliente['nom_cliente'];
        $_SESSION['id_cliente'] = $cliente['id_cliente'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Número de cliente o contraseña incorrectos.";
    }
}
?>
 
<link rel="stylesheet" href="estilos.css">
<h1>👟 King Shoes</h1>
 
<div class="container">
    <h2>Iniciar sesión</h2>
 
    <?php if ($error) echo "<p>❌ $error</p>"; ?>
 
    <form method="POST">
        Número de cliente:<br>
        <input type="text" name="num_cliente" required><br><br>
 
        Contraseña:<br>
        <input type="password" name="password" required><br><br>
 
        <button type="submit">Ingresar</button>
    </form>
 
    <br>
    <a href="registro.php" class="secundario">¿No tenés cuenta? Registrate</a>
</div>