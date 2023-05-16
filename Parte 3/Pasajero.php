<?php

class Pasajero {
    private $nombre;
    private $apellido;
    private $nroAsiento;
    private $nroTicket;

    //creo el metodo constructor de mi clase
    public function __construct ($nombre, $apellido, $nroAsiento){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroAsiento = $nroAsiento;
        //$this->nroTicket = null;
    }

    //creo los metodos de acceso
    public function getNombre (){
    return $this->nombre;
    }

    public function getApellido (){
        return $this->apellido;
    }

    public function getNroAsiento (){
        return $this->nroAsiento;
    }

    public function getNroTicket (){
        return $this->nroTicket;
    }

    //creo los metodos de seteo
    public function setNombre ($newNombre){
    $this->nombre = $newNombre;
    }

    public function setApellido ($newApellido){
        $this->apellido = $newApellido;
    }

    public function setNroAsiento ($newnroAsiento){
        $this->nroAsiento = $newnroAsiento;
    } 

    public function setNroTicket ($newnroTicket){
        $this->nroTicket = $newnroTicket;
    } 

    //creo mi toString para retornar la info de la clase
    public function __toString (){
       return "Nombre: ".$this->getNombre()."\n"."Apellido: ".$this->getApellido()."\n"."Asiento: ".$this->getNroAsiento()."\n"."Ticket: ".$this->getNroTicket()."\n";
    }
   
}