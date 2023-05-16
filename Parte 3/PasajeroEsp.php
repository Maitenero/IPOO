<?php

require_once 'Pasajero.php';

class PasajeroEsp extends Pasajero {

    private $necesidades;

    public function __construct ($nombre, $apellido, $nroAsiento, $necesidades){
        
        parent:: __construct($nombre, $apellido, $nroAsiento);
        $this->necesidades = $necesidades;
    }

    public function getNecesidades (){
        return $this->necesidades;
    }

    public function setNecesidades ($new){
        $this->necesidades = $new;
    }

    public function agregarNecesidad($necesidad) {
        $contenedor = getNecesidades();
        $contenedor[] = $necesidad;
        setNecesidades ($contenedor);
    }

    public function __toString (){
        $cad = parent:: __toString();
        for ($i=0; $i < count($this->getNecesidades()) ; $i++) { 
            $cad = $cad. "El pasajero requiere: ".$this->getNecesidades()[$i]."\n";
        }
        return $cad;
    }
}
