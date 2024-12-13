<?php

namespace Dwes\ProyectoVideoclub;

//Se llama a las excepciones para poder usarlas
use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;


 //Llama a la interface de la que hereda el método muestraResumen

class Cliente implements Resumible{

    public string $nombre;
    private int $numero;
    private string $user;
    private string $password;
    private array $soportesAlquilados;
    private int $numSoportesAlquilados;
    private int $maxAlquilerConcurrente;

    // Se le puede pasar un array o dejarlo vacío. El array se inicializa vacio por defecto
    //IMPORTANTE: en el paréntesis, primero se ponen los parámetros obligatorios y después los opocionales
    public function __construct(string $nom, int $num, string $user, string $password, int $numSopor = 0, array $soportesAlqu = [], int $maxAlqu = 2) {
        $this->nombre = $nom;
        $this->numero = $num;
        $this->user = $user;
        $this->password = $password;
        $this->soportesAlquilados = $soportesAlqu; //es un array
        $this->numSoportesAlquilados = $numSopor;
        $this->maxAlquilerConcurrente = $maxAlqu;
        
    }

    public function getNumero() { 
        return $this->numero;
    }

    public function setNumero($num) {   
        $this->numero = $num;
    }

    public function getNumSoportesAlquilados() { 
        return count($this->soportesAlquilados);
    }
    public function getAlquileres () {
        foreach ($this -> soportesAlquilados as $soporte) {
            echo $soporte;
        }
    }

    public function getUsuario () {
        return $this->user;
    }

    public function getPassword () {
        return $this->password;
    }

    public function setUsuario($usu) {
        $this->user = $usu;
    }

    public function setPassword ($pass) {
        $this->password = $pass;
    }


    public function muestraResumen()
    {
        $soportes = count($this->soportesAlquilados);
        echo ("Nombre: " . $this->nombre . "<br> Cantidad de alquileres: " . $soportes );
    }

    public function tieneAlquilado(Soporte $soporteAlqu) {
        foreach ($this->soportesAlquilados as $soporte) { 
            if ($soporteAlqu->getNumero() == $soporte->getNumero()) {
                return true;
            }
        }
        return false; 
    }
    

// a qué se refiere con si el soporte está alquilado? Soporte no tiene un atributo que diga si está alquilado o no. Se referirá a que si el mismo cliente lo tiene alquilado?

//Hago el método enfocado en comprobar si el cliente ya tiene alquilado el soporte que quiere alquilar
public function alquilar(Soporte $soporte) {
    // Verificar si el soporte ya está alquilado
    if ($this->tieneAlquilado($soporte)) {
        throw new SoporteYaAlquiladoException("Este soporte ya está alquilado.");
    }

    // Verificar si se ha alcanzado el límite de alquileres
    if ($this->getNumSoportesAlquilados() >= $this->maxAlquilerConcurrente) {
        throw new CupoSuperadoException("Se ha superado el cupo de alquileres permitidos.");
    }

    // Añadir soporte a la lista de alquileres del cliente
    array_push($this->soportesAlquilados, $soporte);
    $this->numSoportesAlquilados++;
    $soporte->alquilado = true;  // Actualizar estado del soporte

    //echo("Soporte alquilado a " . $this->nombre);
    return $this; // Permitir encadenamiento de métodos
}


public function devolver (int $numSoporte) {

    foreach ($this->soportesAlquilados as $index => $soporte) {
        // Comprueba si el soporte actual es el que queremos devolver
        if ($numSoporte == $soporte->getNumero()) {
            // Elimina el soporte de la lista de alquileres
            unset($this->soportesAlquilados[$index]);
            $this->numSoportesAlquilados--; // Resta el contador
            echo "El soporte " . $soporte->getTitulo() . " ha sido devuelto con éxito.";
            $soporte->alquilado = false;
            return $this; // Finaliza el método si el soporte ha sido encontrado y devuelto
        }
    }

    // Mensajes de error después de recorrer todo el array
    if ($this->numSoportesAlquilados <= 0) {
        echo "El cliente no tiene ningún soporte alquilado.";
    } else {
        echo "Error. El soporte no existía en la lista de alquilados de este cliente.";
    }

    return $this;

}

public function listarAlquileres () {
    if (count($this->soportesAlquilados) > 0) {
        $lista = "Este cliente tiene " . count($this->soportesAlquilados) . " soportes alquilados. ";
        foreach ($this->soportesAlquilados as $soporte) {
            $lista.="<br>Nombre: " . $soporte->getTitulo() . "<br> Número:  " . $soporte->getNumero();
        }
        echo $lista;
    
    } else {
        echo("Este cliente no tiene soportes alquilados");
    }

}

}

?>