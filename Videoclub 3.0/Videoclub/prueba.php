<?php
include_once 'autoload.php';

use function  Dwes\ProyectoVideoclub\incluirJuego; 
use Dwes\ProyectoVideoclub\Videoclub;
use Dwes\ProyectoVideoclub\Juego;
use Dwes\ProyectoVideoclub\Dvd;



//Se crea el videoclub
$vc = new Videoclub("Severo 8A"); 

//Se incluyen productos en el videoclub
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1); 
$vc->incluirJuego("The Last of Us Part II",  49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente",  4.5, "es","16:9"); 
$vc->incluirDvd("Origen",  4.5, "es,en,fr", "16:9"); 
$vc->incluirDvd("El Imperio Contraataca", 3.9, "es,en","16:9"); 
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107); 
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140); 

//Se crean clientes
$vc->incluirSocio("Steven Spielberg", 1); 
$vc->incluirSocio("David Hasselhawk", 2);

//Da error al lanzar las excepciones.
//$vc->alquilarSocioProducto(1,1) ->alquilarSocioProducto(1,2)->alquilarSocioProducto(1,1) ->alquilarSocioProducto(1,3)-> alquilarSocioProducto(2,5); 

$arrayprods = [];
$juego = new Juego ("The Last of Us Part II",  49.99, "PS4", 1, 1);
$dvd = new Dvd ("Origen",  4.5, "es,en,fr", "16:9"); 
$dvd2 = new Dvd ("Origen",  4.5, "es,en,fr", "16:9");
array_push($arrayprods, $juego);
array_push($arrayprods, $dvd);
array_push($arrayprods, $dvd2);


$vc->alquilarSocioProductos(1, [6, 7, 3, 6]);  
$vc->devolverSocioProducto(1,7)->devolverSocioProducto(1,6);
$vc->devolverSocioProductos(1, [56, 7, 13, 6]); 
//var_dump($arrayprods);

//$vc->listarProductos();


?>