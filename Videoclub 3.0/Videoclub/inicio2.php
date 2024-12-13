<?php
namespace Dwes\ProyectoVideoclub;


include_once "Soporte.php";
include_once "CintaVideo.php";
include_once "Dvd.php";
include_once "Juego.php";
include_once "Cliente.php";

//instanciamos un par de objetos cliente
$cliente1 = new Cliente("Bruce Wayne", 23, 0);
$cliente2 = new Cliente("Clark Kent", 33, 0);

//mostramos el número de cada cliente creado 
echo "<br>El identificador del cliente 1 es: " . $cliente1->getNumero();
echo "<br>El identificador del cliente 2 es: " . $cliente2->getNumero() . "<br>";

//instancio algunos soportes 
$soporte1 = new CintaVideo("Los cazafantasmas", 23, 3.5, 107);
$soporte2 = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1);  
$soporte3 = new Dvd("Origen", 24, 15, "es,en,fr", "16:9");
$soporte4 = new Dvd("El Imperio Contraataca", 4, 3, "es,en","16:9");



//alquilo algunos soportes
echo(" <br> ALQUILER DE SOPORTES: <br>");
$cliente1->alquilar($soporte1);
echo ("<br>");
$cliente1->alquilar($soporte2);
echo ("<br>");
$cliente1->alquilar($soporte3);
echo ("<br> <br>");



//voy a intentar alquilar de nuevo un soporte que ya tiene alquilado
$cliente1->alquilar($soporte1); // No puede porque ya lo tiene alquilado BIEN

echo ("<br>");
//el cliente tiene 3 soportes en alquiler como máximo
//este soporte no lo va a poder alquilar
$cliente1->alquilar($soporte4); //BIEN

echo ("<br>");
//este soporte no lo tiene alquilado BIEN
$cliente1->devolver(2);

echo ("<br>");
//devuelvo un soporte que sí que tiene alquilado
$cliente1->devolver(26); 
//ERROR. Solo hace la devolucón si son cintas de video

echo ("<br>");
//alquilo otro soporte BIEN
$cliente1->alquilar($soporte4);

echo ("<br>");
//listo los elementos alquilados
$cliente1->listarAlquileres();

echo ("<br>");
//este cliente no tiene alquileres
$cliente2->devolver(24);