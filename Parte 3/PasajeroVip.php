<?php

require_once 'Pasajero.php';

class PasajeroVip extends Pasajero {

    private $nroViajeroFrecuente;
    private $millas;

    public function __construct ($nombre, $apellido, $nroAsiento, $nroViajeroFrecuente, $millas){
        
        parent:: __construct($nombre, $apellido, $nroAsiento);
        $this->nroViajeroFrecuente = $nroViajeroFrecuente;
        $this->millas = $millas;

    }

    public function getNroViajeroFrecuente (){
        return $this->nroViajeroFrecuente;
    }

    public function getMillas (){
        return $this->millas;
    }

    public function setNroViajeroFrecuente ($new){
        $this->nroViajeroFrecuente = $new;
    }

    public function setMillas ($new){
        $this->millas = $new;
    }

    public function __toString (){
        $cad = parent:: __toString();
        $cad = $cad . "El numero de viajero frecuente es: ".$this->getNroViajeroFrecuente()."\n";
        $cad = $cad . "El numero de millas del pasajero es de: ".$this->getMillas()."\n";
        return $cad;
    }


}