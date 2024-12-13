<?php

include_once '../vendor/autoload.php';
use Dwes\ProyectoVideoclub\Videoclub;

session_start();

// Verificar si la sesión contiene un objeto Videoclub válido
if (!isset($_SESSION["videoclub"]) || !$_SESSION["videoclub"] instanceof Videoclub) {
    die("Error: No se ha inicializado correctamente el videoclub en la sesión.");
}

// Depurar sesión
$_SESSION["videoclub"];
echo "<br>";

// Recuperar el videoclub de la sesión
$vc = $_SESSION["videoclub"];
$socios = $vc->getSocios();

// Validar que $_POST contenga los datos necesarios
if (!isset($_POST["usuario"]) || empty($_POST["usuario"])) {
    die("Error: Debes ingresar un número de cliente válido.");
}

$numeroSocio = intval($_POST["usuario"]);

// Bandera para verificar si se encontró y eliminó el socio
$eliminado = false;

// Buscar al socio por número y eliminarlo
foreach ($socios as $index => $socio) {
    if ($socio->getNumero() == $numeroSocio) {
        unset($socios[$index]); // Eliminar del arreglo
        $vc->setSocios(array_values($socios)); // Reindexar y actualizar el Videoclub
        $_SESSION["videoclub"] = $vc; // Actualizar la sesión
        $eliminado = true;
        break;
    }
}

// Confirmar si el cliente fue eliminado
if ($eliminado) {
    echo "Cliente con número $numeroSocio eliminado correctamente.";
    header("Location: mainAdmin.php");
    exit();
} else {
    die("Error: No se encontró un socio con el número especificado.");
}
?>
