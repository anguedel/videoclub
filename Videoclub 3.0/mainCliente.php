<?php

include_once '../vendor/autoload.php';
use Dwes\ProyectoVideoclub\Socio;

session_start();

$socio = $_SESSION['socio'];
$vc = $_SESSION["videoclub"];
$clientes = $vc->getSocios(); 

//USAR VIDEOCLUB PARA JUGAR CON EL CLIENTE. DE ESTA MANERA SE VERÁN REFLEJADOS LOS CAMBIOS QUE SE HACEN EN UPDATECLIENTE

if (esCliente($socio->nombre, $clientes)) {
    echo "<h4>Bienvenido/a  $socio->nombre</h4>";

    $socio->listarAlquileres();
   
    echo '<form action="logout.php" method="POST">';
    echo '<input type="submit" value="Salir de la sesión" name="enviar" />';
    echo '</form>';
} 
// Si no es ni admin ni cliente validado
else {
    echo "<p>No tienes permiso para ver esta información. Por favor, inicia sesión.</p>";
    echo '<p><a href="index.php">Iniciar sesión</a></p>';
}

// Función para comprobar si un nombre existe en el array de clientes
function esCliente($nombre, $clientes) {
    foreach ($clientes as $cliente) {
        if ($cliente->nombre === $nombre) {
            return true; // Nombre encontrado
        }
    }
    return false; // Nombre no encontrado
}

echo '<form action="formUpdateCliente.php" method="POST">'; 
echo '<input type="submit" value="Modificar datos" name="enviar" />';
echo '</form';







?>