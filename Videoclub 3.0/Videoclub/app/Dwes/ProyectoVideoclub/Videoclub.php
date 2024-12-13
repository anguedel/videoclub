<?php

namespace Dwes\ProyectoVideoclub;

use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;

class Videoclub {

    private string $nombre;
    private array $productos;
    private int $numProductos;
    private array $socios;
    private int $numSocios;
    private $numProductosAlquilados;
    private $numTotalAlquileres;

    public function __construct (string $nom, int $numProd = 0, int $numSoc = 0, array $soc = [], array $prods = []) {
        $this->nombre = $nom;
        $this->productos = $prods;
        $this->numProductos = $numProd;
        $this->socios = $soc;
        $this->numSocios = $numSoc;
    }

    private function incluirProducto (Soporte $producto) { //agrega un producto a la lista de productos del videoclub
        array_push($this->productos, $producto);
    }

    //EN EL DIAGRAMA DE CLASES NO INDICA QUE SE PONGA EL NUMERO DE SOPORTE EN LOS MÉTODOS DE INCLUIR QUE VIENEN A CONTINUACION, LO QUE IMPIDE QUE LUEGO SE PUEDAN ALQUILAR,YA QUE ES NECESARIO INDICAR DICHO NUMERO. ADEMAS, SEGURAMENTE LOS METODOS DEN ERROR PORQUE ESE PARAMETRO ES OBLIGATORIO.

    public function incluirCintaVideo ($titulo, $precio, $duracion) //FALTA EL PARAMETRO DEL NUMERO DE SOPORTE
     {
        $cinta = new CintaVideo($titulo, $precio, $duracion);
        $this->incluirProducto($cinta);
        //echo("Incluido soporte " . $cinta->getNumero() . "<br>");

    }

    public function incluirDvd ($titulo, $precio, $idiomas, $pantalla) {
        $dvd = new Dvd($titulo, $precio, $idiomas, $pantalla);
        $this->incluirProducto($dvd);
        //echo("Incluido soporte " . $dvd->getNumero() . "<br>");

    }

    public function incluirJuego ($titulo, $precio, $consola, $minJ, $maxJ) {
        $juego = new Juego ($titulo, $precio, $consola, $minJ, $maxJ);
        $this->incluirProducto($juego);
       // echo("Incluido soporte " . $juego->getNumero() . "<br>");

    }

    public function incluirSocio ($nombre, $user, $password, $maxAlquileresConcurrentes = 3) {
        $socio = new Cliente($nombre, $user, $password, $maxAlquileresConcurrentes);
        array_push($this->socios, $socio);
        $this->numSocios++;
        //echo ("Inluido socio " . $this->numSocios . "<br>");

    }

    public function getSocios() {
        return $this->socios;
    }

    public function getProductos() {
        return $this->productos;
    }

    public function listarProductos() {
        if (count($this->productos) > 0) {
            echo ("Listado de los " . count($this->productos) . " productos disponibles. <br>");
            $contador = 1;
            foreach ($this->productos as $producto) {
                
                if ($producto instanceof Juego) {
                    echo($contador . "- Juego para: " . $producto->getConsola() . "<br>");
                    $producto->muestraResumen();
                    echo"<br>";
                } elseif ($producto instanceof Dvd) {
                    echo($contador . "- Película en DVD:<br>");
                    $producto->muestraResumen();
                    echo"<br>";

                } elseif ($producto instanceof CintaVideo) {
                    echo($contador . "- Película en VHS:<br>");
                    $producto->muestraResumen();
                    echo"<br>";

                } else {
                    echo "Producto desconocido<br>";
                }
                $contador++;
            }
        } else {
            echo "No hay productos disponibles.<br>";
        }
    }
    
    public function listarSocios () {
        if (count($this->socios) > 0) {
            echo ("Listado de los " . count($this->socios) . " socios del videoclub. <br>" );
            foreach ($this->socios as $socio) {
                $socio->muestraResumen();
                echo("<br>");
            }
     }

    }

    public function alquilarSocioProducto($numCliente, $numProd) {
        $clienteEncontrado = null;
        $productoEncontrado = null;
    
        // Buscar el cliente por su número
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numCliente) {
                $clienteEncontrado = $socio;
                break;
            }
        }
    
        if (!$clienteEncontrado) {
            echo "El número de socio indicado no existe en el videoclub.<br>";
            return $this;
        }
    
        // Buscar el producto por su número (corrigiendo el error)
        foreach ($this->productos as $producto) {
            if ($producto->getNumero() == $numProd) { // Comparar directamente con el número
                $productoEncontrado = $producto;
                break;
            }
        }
    
        if (!$productoEncontrado) {
            echo "El número de soporte indicado no existe en el videoclub.<br>";
            return $this;
        }
    
        // Realizar el alquiler llamando al método 'alquilar' de 'Cliente'
        try {
            $resultadoAlquiler = $clienteEncontrado->alquilar($productoEncontrado);
        } catch (SoporteYaAlquiladoException $e) {
            echo "Error: " . $e->getMessage() . "<br>"; // Muestra el mensaje de error de la excepción
            return $this;
        } catch (CupoSuperadoException $e) {
            echo "Error: " . $e->getMessage() . "<br>"; // Muestra el mensaje de error de la excepción
            return $this;
        }
    
        // Confirmar el alquiler
        if ($resultadoAlquiler) {
            echo "<br>" . $productoEncontrado->getTitulo() . " ha sido alquilado a " . $clienteEncontrado->nombre . "<br>";
        }
    
        // Mostrar el resumen del producto alquilado
        echo($productoEncontrado->muestraResumen());
        return $this;
    }
    
    public function getNumProductosAlquilados () {
        return $this->numProductosAlquilados;
    }

    public function getNumTotalAlquileres () {
        return $this->numTotalAlquileres;
    }

    public function alquilarSocioProductos($numSocio, $numerosProducto) {
        $todosAlquilados = true;
        
        // Se asume que $numerosProducto es un array con los números de producto que quieres alquilar
        foreach ($numerosProducto as $numProducto) {
            // Buscar el producto por número
            $productoEncontrado = null;
            foreach ($this->productos as $producto) {
                if ($producto->getNumero() == $numProducto) { // Asegúrate de comparar con el número, no con un objeto
                    $productoEncontrado = $producto;    
                    break;
                }
            }
    
            if (!$productoEncontrado) {
                echo "El producto con número " . $numProducto . " no existe.<br>";
                $todosAlquilados = false;
                continue;
            }
    
            // Verificar si el producto ya está alquilado
            if ($productoEncontrado->alquilado == true) { // Verifica si ya está alquilado
                echo "El producto " . $productoEncontrado->getTitulo() . " ya está alquilado y no está disponible.<br>";
                $todosAlquilados = false;
                continue;
            }
    
            // Intentar alquilar el producto
            $resultado = $this->alquilarSocioProducto($numSocio, $productoEncontrado); // Pasar el objeto completo
            if ($resultado) {
                echo "El producto " . $productoEncontrado->getTitulo() . " ha sido alquilado con éxito.<br>";
                $productoEncontrado->alquilado = true; // Marcar como alquilado
            } else {
                echo "No se pudo alquilar el producto " . $productoEncontrado->getTitulo() . ".<br>";
                $todosAlquilados = false;
            }
        }
    
        if ($todosAlquilados) {
            echo "Todos los productos solicitados han sido alquilados con éxito.<br>";
        } else {
            echo "Algunos productos no pudieron ser alquilados.<br>";
        }
    }

    //Sale la excepción de cupo de alquileres superado pero de todas formas lo alquila y muestra el mensaje de que todos los productos han sido alquilados con éxito. No se comprueba si el número de cliente existe

    public function devolverSocioProducto($numSocio, $numProducto) {
        // Inicializar variables de control
        $socioEncontrado = null;
        $productoEncontrado = null;
    
        // Buscar el socio por número de socio
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numSocio) {
                $socioEncontrado = $socio;
                break;  // Sale del bucle una vez que encuentra el socio
            }
        }
    
        // Verificar si el socio fue encontrado
        if (!$socioEncontrado) {
            echo "El cliente con número " . $numSocio . " no existe.<br>";
            return $this;
        }
    
        // Buscar el producto por número de producto
        foreach ($this->productos as $producto) {
            if ($producto->getNumero() == $numProducto) {
                $productoEncontrado = $producto;
                break;  // Sale del bucle una vez que encuentra el producto
            }
        }
    
        // Verificar si el producto fue encontrado
        if (!$productoEncontrado) {
            echo "El producto con número " . $numProducto . " no existe.<br>";
            return $this;
        }
    
        // Verificar si el socio tiene el producto alquilado
        if (!$socioEncontrado->tieneAlquilado($productoEncontrado)) {
            echo "El producto " . $productoEncontrado->getTitulo() . " no ha sido alquilado por el socio.<br>";
            return $this;
        }
    
        // Realizar la devolución del producto
        $socioEncontrado->devolver($productoEncontrado->getNumero());
        echo "El producto " . $productoEncontrado->getTitulo() . " ha sido devuelto por el socio " . $socioEncontrado->nombre . ".<br>";
    
        return $this;
    }

    public function devolverSocioProductos($numSocio, $numProductos) {
        // Buscar el socio por número de socio
        $socioEncontrado = null;
        foreach ($this->socios as $socio) {
            if ($socio->getNumero() == $numSocio) {
                $socioEncontrado = $socio;
                break;
            }
        }
    
        // Verificar si el socio fue encontrado
        if (!$socioEncontrado) {
            echo "El cliente con número " . $numSocio . " no existe.<br>";
            return $this;
        }
    
        // Iterar sobre cada número de producto en la lista de productos a devolver
        foreach ($numProductos as $numProducto) {
            $productoEncontrado = null;
    
            // Buscar el producto en la lista de productos del videoclub
            foreach ($this->productos as $producto) {
                if ($producto->getNumero() == $numProducto) {
                    $productoEncontrado = $producto;
                    break;
                }
            }
    
            // Verificar si el producto fue encontrado
            if (!$productoEncontrado) {
                echo "El producto con número " . $numProducto . " no existe.<br>";
                continue;
            }
    
            // Verificar si el socio tiene el producto alquilado
            if (!$socioEncontrado->tieneAlquilado($productoEncontrado)) {
                echo "El producto " . $productoEncontrado->getTitulo() . " no ha sido alquilado por el socio.<br>";
                continue;
            }
    
            // Realizar la devolución del producto
            $socioEncontrado->devolver($productoEncontrado);
            echo "El producto " . $productoEncontrado->getTitulo() . " ha sido devuelto por el socio " . $socioEncontrado->getNombre() . ".<br>";
        }
    
        return $this;
    }
}

?>