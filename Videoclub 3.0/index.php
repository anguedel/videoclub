<?php

session_start();
include_once '../vendor/autoload.php';

use Dwes\ProyectoVideoclub\Videoclub;
echo __DIR__;
// Cargar o inicializar el objeto Videoclub
if (isset($_SESSION['videoclub']) && $_SESSION['videoclub'] instanceof Videoclub) {
    $vc = $_SESSION['videoclub'];
} elseif (file_exists('data/videoclub.dat')) {
    // Restaurar desde archivo
    $vc = unserialize(file_get_contents('data/videoclub.dat'));
    $_SESSION['videoclub'] = $vc;
} else {
    // Inicializar un nuevo Videoclub
    $vc = new Videoclub("Videoclub Cristie");
    
    // Agregar datos iniciales (opcional)
    $vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
    $vc->incluirJuego("The last of us Part 2", "49.99", "PS4", 1, 1);
    $vc->incluirDvd("Torrente", 3.50, "es", "16:9");
    $vc->incluirDvd("Origen", "3.50", "es, en, fr", "16:9");
    $vc->incluirCintaVideo("Los cazafantasmas", 2.50, 107);
    $vc->incluirCintaVideo("El nombre de la rosa", 2.50, 140);
    $vc->incluirSocio("Pedro González", 1, "pedrin", "Pedraco24");
    $vc->incluirSocio("Zinedine Zidane", 2, "zinedinio", "madrit");
    $vc->incluirSocio("María de las Mercedes", 3, "maria", "maria");
    
    $_SESSION['videoclub'] = $vc; // Guardar en sesión
    $_SESSION['socios'] = $vc->getSocios();
    $_SESSION['soportes'] = $vc->getProductos();
}

// Mostrar mensaje de error si existe
if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']); // Limpiar el error después de mostrarlo
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videoclub - Inicio de Sesión</title>
</head>
<body>
    <form action="login.php" method="post">
        <fieldset>
            <legend>Inicio de Sesión</legend>
            <label for="usuario">Usuario:</label>
            <input type="text" name="inputUsuario" id="usuario" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" name="inputPassword" id="password" required>
            <br>
            <button type="submit" name="enviar">Iniciar Sesión</button>
        </fieldset>
    </form>
</body>
</html>
