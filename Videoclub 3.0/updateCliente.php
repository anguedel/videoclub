<?php
include_once '../vendor/autoload.php';
use Dwes\ProyectoVideoclub\Videoclub;

session_start();

// Verificar si la sesión contiene el objeto Videoclub
if (!isset($_SESSION["videoclub"]) || !$_SESSION["videoclub"] instanceof Videoclub) {
    die("Error: No se ha inicializado correctamente el videoclub en la sesión.");
}

// Recuperar el videoclub y los datos enviados por el formulario
$vc = $_SESSION["videoclub"];
$nombre = htmlspecialchars(trim($_POST["nombre"] ?? ''));
$usuario = htmlspecialchars(trim($_POST["usuario"] ?? ''));
$password = htmlspecialchars(trim($_POST["password"] ?? ''));

// Verificar los datos
if (empty($nombre) || empty($usuario) || empty($password)) {
    $_SESSION['error'] = "Todos los campos son obligatorios.";
    header("Location: formUpdateCliente.php");
    exit();
}

// Actualizar los datos del cliente en el Videoclub
foreach ($vc->getSocios() as $socio) {
    if ($socio->getNumero() === $_SESSION['socio']->getNumero()) {
        $socio->$nombre;
        $socio->setUsuario($usuario);
        $socio->setPassword($password);

        // Actualizar la sesión
        $_SESSION['socio'] = $socio;
        $_SESSION['videoclub'] = $vc;
        break;
    }
}

// Redirigir al cliente a su página principal
header("Location: mainCliente.php");
exit();
