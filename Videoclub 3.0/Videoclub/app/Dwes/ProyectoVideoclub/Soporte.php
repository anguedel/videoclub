<?php

namespace Dwes\ProyectoVideoclub;


 //Llama a la interface de la que hereda el método muestraResumen

abstract class Soporte implements Resumible{
    public string $titulo;
    private float $precio;
    private static float $IVA = 1.21;
    private static int $contadorNumero = 0;  // Este contador lleva el total
    private int $numero;  // Este almacena el número único por objeto
    public bool $alquilado = false;
    
    public function __construct(string $titu, float $pr) {
        $this->titulo = $titu;
        $this->precio = $pr;
        self::$contadorNumero++;
        $this->numero = self::$contadorNumero;  // Asigna un número único al objeto
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getPrecioConIva(): string
    {
        return $this->precio * self::$IVA;
    }

    public function muestraResumen()
    {
        echo ("Título: " . $this->titulo . "<br> Número: " . $this->numero . "<br> Precio sin IVA: " . $this->getPrecio()  . "<br> Precio con IVA: " . $this->getPrecioConIva());
    }

}

?>