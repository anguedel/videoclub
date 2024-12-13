<?php
include_once '../vendor/autoload.php';

use Dwes\ProyectoVideoclub\Videoclub;

session_start();
$nombre = $_SESSION["usuario"];
$peliculas = $_SESSION["soportes"];
$clientes = $_SESSION["socios"];
$vc = $_SESSION["videoclub"];
$cont = 1;

if (isset($_SESSION['usuario'])) {
    // Si el usuario es administrador
    if ($_SESSION['usuario'] == "admin") {
        echo "<h4>Bienvenido/a $nombre </h4> <br>";

        echo '<form action="logout.php" method="POST">'; 

        echo "<h2>Listado de películas</h2>";
        echo "<ul>";


        /*
        // Recorremos las películas para generar la lista de películas
        foreach ($peliculas as $pelicula) {
            echo " <h3>Soporte $cont </h3>";
            foreach ($pelicula as $clave => $valor) {
                echo "<li><strong>$clave </strong> -- $valor</li>";
            }
            echo "------------------------- <br>";
            $cont++;
        } */

        $vc->listarProductos();
        

        echo "<h2>Listado de clientes</h2>";
        $vc = $_SESSION["videoclub"];
        $vc->listarSocios();
        echo "<br>";

        echo '<input type="submit" value="Salir de la sesión" name="enviar"  />';
        echo '</form> <br>';


    } 
    
    else {
        echo "<p>No tienes permiso para ver esta información. Por favor, inicia sesión.</p>";
        echo '<p><a href="index.php">Iniciar sesión</a></p>';
    }
} else {
    // Caso en el que no hay sesión iniciada
    echo "<p>No tienes permiso para ver esta información. Por favor, inicia sesión.</p>";
    echo '<p><a href="index.php">Iniciar sesión</a></p>';
}

// Función para comprobar si un nombre existe en el array de clientes
function esCliente($nombre, $clientes) {
    foreach ($clientes as $cliente) {
        if ($cliente['Nombre'] === $nombre) {
            return true; // Nombre encontrado
        }
    }
    return false; // Nombre no encontrado
}

echo '<form action="formCreateCliente.php" method="POST">'; 
echo '<input type="submit" value="Crear usuario" name="enviar" />';
echo '</form> <br>';

echo '<form action="formUpdateCliente.php" method="POST">'; 
echo '<input type="submit" value="Modificar datos" name="enviar" />';
echo '</form';












?>
