<?php

include_once 'autoload.php';

 // Incluye el archivo desde donde importan la funcion y la clase 

use function  Dwes\ProyectoVideoclub\incluirJuego; // Importar función desde un archivo con el que comparte carpeta
use Dwes\ProyectoVideoclub\Videoclub;
 //Importa una clase desde un archivo con el que comparte carpeta

$vc = new Videoclub("Severo 8A"); 

//voy a incluir unos cuantos soportes de prueba 
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1); 
$vc->incluirJuego("The Last of Us Part II",  49.99, "PS4", 1, 1);
$vc->incluirDvd("Torrente",  4.5, "es","16:9"); 
$vc->incluirDvd("Origen",  4.5, "es,en,fr", "16:9"); 
$vc->incluirDvd("El Imperio Contraataca", 3.9, "es,en","16:9"); 
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107); 
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140); 
//He añadido el parametro del numero de soporte porque si no, no se podian crear los soportes

//listo los productos 
$vc->listarProductos() ; 

//voy a crear algunos socios 
$vc->incluirSocio("Amancio Ortega", 1, "Aman", "Aman56"); 
$vc->incluirSocio("Pablo Picasso", 2, "Pableishon", "Peppi23"); 

$vc->alquilarSocioProducto(1,2) ->alquilarSocioProducto(2,3) ->alquilarSocioProducto(1,2)-> alquilarSocioProducto(1,6); 
echo ("<br>");

echo ("<br> <br> <br>" );

//listo los socios 
$vc->listarSocios();



?>