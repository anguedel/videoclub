<?php

include_once '../vendor/autoload.php';
use Dwes\ProyectoVideoclub\Videoclub;

session_start();

// Verificar si la sesión contiene un objeto Videoclub válido
if (!isset($_SESSION["videoclub"]) || !$_SESSION["videoclub"] instanceof Videoclub) {
    die("Error: No se ha inicializado correctamente el videoclub en la sesión.");
}

// Recuperar el videoclub de la sesión
$vc = $_SESSION["videoclub"];

// Verificar que se recibieron todos los datos necesarios
if (empty($_POST["nombre"]) || empty($_POST["numero"]) || empty($_POST["usuario"]) || empty($_POST["password"])) {
    $_SESSION['error'] = "Todos los campos son obligatorios.";
    header("Location: mainAdmin.php");
    exit();
}

// Recuperar los datos del formulario y sanitizarlos
$nombre = htmlspecialchars(trim($_POST["nombre"]));
$numero = filter_var($_POST["numero"], FILTER_VALIDATE_INT);
$usuario = htmlspecialchars(trim($_POST["usuario"]));
$password = htmlspecialchars(trim($_POST["password"]));

// Validar el número de socio
if ($numero === false || $numero <= 0) {
    $_SESSION['error'] = "El número de socio debe ser un número positivo.";
    header("Location: mainAdmin.php");
    exit();
}

// Añadir el nuevo socio al videoclub
$vc->incluirSocio($nombre, $numero, $usuario, $password);

// Actualizar la sesión con los datos modificados
$_SESSION["videoclub"] = $vc;
//$vc->listarSocios();

// Redirigir al administrador
header("Location: mainAdmin.php");
exit();

?>
