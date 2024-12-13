<?php

namespace Dwes\ProyectoVideoclub;

class CintaVideo extends Soporte {

private int $duracion;

public function __construct( string $titu, float $pr, int $dura ) {
    parent::__construct($titu, $pr);
    $this->duracion = $dura;
    
}

public function getDuracion () {
    return $this->duracion;
}

public function muestraResumen()
{
    $resumen = parent::muestraResumen(); // Llama al mismo método del padre y lo sobreescribe
    echo  $resumen . " " .  $this->getDuracion() . " minutos <br>";
}

}

?>