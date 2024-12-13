<?php

namespace Dwes\ProyectoVideoclub;

class Dvd extends Soporte {

public string $idiomas;  
private string $formatPantalla;

public function __construct( string $titu, float $pr, string $idio, string $form ) {
    parent::__construct($titu, $pr);
    $this->idiomas = $idio;
    $this->formatPantalla = $form;
}

public function getIdiomas () {
    return $this->idiomas;
}

public function getFormato () {
    return $this->formatPantalla;
}


public function muestraResumen()
{
    $resumen = parent::muestraResumen(); // Llama al mismo método del padre y lo sobreescribe
    echo $resumen . "<br> Idiomas: " .  $this->getIdiomas() . " <br> Formato de pantalla: " . $this->getFormato() . " <br>";
}

}

?>