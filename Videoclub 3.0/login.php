<?php
session_start();
include_once '../vendor/autoload.php';
use Dwes\ProyectoVideoclub\Videoclub;

// Recuperar o inicializar Videoclub
if (isset($_SESSION['videoclub']) && $_SESSION['videoclub'] instanceof Videoclub) {
    $vc = $_SESSION['videoclub'];
} else {
    $vc = new Videoclub("Videoclub Cristie");
    // Agregar datos iniciales si es necesario
    $_SESSION['videoclub'] = $vc;
}

// Procesar formulario de inicio de sesión
if (isset($_POST['enviar'])) {
    $usuario = htmlspecialchars($_POST['inputUsuario']);
    $password = htmlspecialchars($_POST['inputPassword']);

    // Validar parámetros
    if (empty($usuario) || empty($password)) {
        $_SESSION['error'] = "Debes introducir un usuario y contraseña.";
        header("Location: index.php");
        exit();
    }

    // Validar credenciales para admin
    if ($usuario === "admin" && $password === "admin") {
        $_SESSION['usuario'] = $usuario;
        header("Location: mainAdmin.php");
        exit();
    }

    // Validar credenciales en el array de socios
    foreach ($vc->getSocios() as $socio) {
        if ($usuario === $socio->getUsuario() && $password === $socio->getPassword()) {
            $_SESSION['usuario'] = $socio->nombre; // Guardar nombre del socio
            $_SESSION['socio'] = $socio; // Guardar objeto socio
            header("Location: mainCliente.php");
            exit();
        }
    }

    // Credenciales no válidas
    $_SESSION['error'] = "Usuario o contraseña no válidos.";
    header("Location: index.php");
    exit();
}
?>
