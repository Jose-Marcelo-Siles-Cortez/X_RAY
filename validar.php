<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

session_start();
$_SESSION['usuario'] = $usuario;

$conexion = mysqli_connect("localhost", "root", "", "rol");

$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_fetch_array($resultado);

if ($filas) {
    if ($filas['id_cargo'] == 1) {
        header("location:admin.php"); // Administrador
    } elseif ($filas['id_cargo'] == 2) {
        header("location:auxiliar.php"); // Cliente
    } elseif ($filas['id_cargo'] == 3) {
        header("location:cajero.php"); // Cajero
    } elseif ($filas['id_cargo'] == 4) {
        header("location:almacen.php"); // Almacén
    } elseif ($filas['id_cargo'] == 5) {
        header("location:vendedor.php"); // Vendedor
    }
} else {
    include("index.html");
    echo '<h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>';
}

mysqli_free_result($resultado);
mysqli_close($conexion);
?>
