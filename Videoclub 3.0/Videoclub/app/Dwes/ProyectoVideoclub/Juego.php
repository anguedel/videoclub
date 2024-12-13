<?php

namespace Dwes\ProyectoVideoclub;

class Juego extends Soporte {

    public string $consola;
    private int $minNumJugadores;
    private int $maxNumJugadores;

    public function __construct( string $titu, float $pr, string $cons, int $min, int $max ) {
        parent::__construct($titu, $pr);
        $this->consola = $cons;
        $this->minNumJugadores = $min;
        $this->maxNumJugadores = $max;
    }

    public function getConsola() {
        return $this->consola;
    }   
    
    public function getMinJugadores () {
        return $this->minNumJugadores;
    }

    public function getMaxJugadores () {
        return $this->maxNumJugadores;
    }

    public function muestraJugadoresPosibles () {
        $min = $this->getMinJugadores();
        $max = $this->getMaxJugadores();

        if ($min == 1 && $max ==1) {
            return "Para un jugador.";
        } else if ($max == $min ) {
            return "Para " . $max . " jugadores";
        } else {
            return "Para entre" . $min . " y " . $max .  " jugadores.";

        }

    }

    public function muestraResumen()
{
    $resumen = parent::muestraResumen(); // Llama al mismo método del padre y lo sobreescribe
    echo $resumen . " " . " <br> Consola: " . $this->getConsola() .   " <br> Jugadores: " .$this->muestraJugadoresPosibles() . " <br>" ;
}

}

?>