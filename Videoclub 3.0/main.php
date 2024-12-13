<?php
session_start();
$nombre = $_SESSION["usuario"];


// Verificar si el usuario está autenticado
if (isset($_SESSION['usuario']) ) {

     if( $_SESSION['usuario'] == "usuario")  {
    echo "<h4>Bienvenido/a $nombre </h4> <br>";
    echo '<form action="logout.php" method="POST">'; 


    }

} else {
    // Mostrar mensaje si el usuario no ha iniciado sesión
    echo "<p>No tienes permiso para ver esta información. Por favor, inicia sesión.</p>";

    // Opcional: incluir un enlace a la página de inicio de sesión
    echo '<p><a href="index.php">Iniciar sesión</a></p>';
}

echo '<input type="submit" value="Salir de la sesión" name="enviar" />
</form>';
    

?>
