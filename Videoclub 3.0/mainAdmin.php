<?php
include_once '../vendor/autoload.php';

session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["usuario"])) {
    echo "<p>No tienes permiso para ver esta información. Por favor, inicia sesión.</p>";
    echo '<p><a href="index.php">Iniciar sesión</a></p>';
    exit();
}

$nombre = $_SESSION["usuario"];
$vc = $_SESSION["videoclub"] ?? null;

// Validar que el videoclub esté disponible en la sesión
if (!$vc instanceof \Dwes\ProyectoVideoclub\Videoclub) {
    die("Error: Videoclub no inicializado correctamente en la sesión.");
}

// Bienvenida según el usuario
if ($nombre === "admin") {
    echo "<h4>Bienvenido/a $nombre</h4>";

    // Listar películas
    echo "<h2>Listado de películas</h2>";
    echo "<ul>";
    $vc->listarProductos();
    echo "</ul>";

    // Listar clientes
    echo "<h2>Listado de clientes</h2>";
    $vc->listarSocios();

    echo '<br>';

    // Botón de logout
    echo '<form action="logout.php" method="POST">';
    echo '<input type="submit" value="Salir de la sesión" name="enviar" />';
    echo '</form><br>';

    // Formularios adicionales
    echo '<form action="formCreateCliente.php" method="POST">';
    echo '<input type="submit" value="Crear usuario" name="enviar" />';
    echo '</form><br>';

    echo '<form action="formUpdateCliente.php" method="POST">';
    echo '<input type="submit" value="Modificar datos" name="enviar" />';
    echo '</form><br>';

    echo '<form action="removeCliente.php" method="POST">';
    echo '<label for="usuario">Número de cliente:</label>';
    echo '<input type="number" id="usuario" name="usuario" value="" required>';
    echo '<input type="submit" value="Eliminar cliente" name="enviar" />';
    echo '</form>';
} else {
    // Si el usuario no es administrador
    echo "<p>No tienes permiso para ver esta información. Por favor, inicia sesión.</p>";
    echo '<p><a href="index.php">Iniciar sesión</a></p>';
}

?>
