<?php
include_once '../vendor/autoload.php';

session_start();
/*
$cliente = $_SESSION['videoclub']; // Objeto del cliente guardado en la sesión
$nombre = $cliente->Nombre ?? ''; // Usar una propiedad o asignar vacío si no existe
$numero = $cliente->getNumero() ?? ''; // Usar el getter o asignar vacío
$usuario = $cliente->getUsuario() ?? ''; // Usar el getter o asignar vacío
$password = $cliente->getPassword() ?? ''; // Usar el getter o asignar vacío

cargar valores originales en el formulario
<?= htmlspecialchars($nombre) ?>
<?= htmlspecialchars($numero) ?>
<?= htmlspecialchars($usuario) ?>
<?= htmlspecialchars($password) ?>
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar los datos del cliente</title>
</head>
<body>

<form action="updateCliente.php" method="post">
     
     <label for="nombre">Nombre y apellidos</label>
     <input type="text" id="nombre" name="nombre" value="" required>
     <br><br>

     <label for="usuario">Usuario</label>
     <input type="text" id="usuario" name="usuario" value="">
     <br><br>

     <label for="password">Contraseña</label>
     <input type="text" id="password" name="password" value="">
     <br><br>

     <button type="submit">Actualizar</button>
</form>

</body>
</html>

