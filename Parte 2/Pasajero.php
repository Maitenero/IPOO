<?php

class Pasajero {
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $telefono;

    //creo el metodo constructor de mi clase
    public function __construct ($nombre, $apellido, $nroDocumento, $telefono){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nroDocumento = $nroDocumento;
        $this->telefono = $telefono;
    }

    //creo los metodos de acceso
    public function getNombre (){
    return $this->nombre;
    }

    public function getApellido (){
        return $this->apellido;
    }

    public function getNroDocumento (){
        return $this->nroDocumento;
    }

    public function getTelefono (){
        return $this->telefono;
    }

    //creo los metodos de seteo
    public function setNombre ($newNombre){
    $this->nombre = $newNombre;
    }

    public function setApellido ($newApellido){
        $this->apellido = $newApellido;
    }

    public function setNroDocumento ($newNroDocumento){
        $this->nroDocumento = $newNroDocumento;
    } 

    public function setTelefono ($newTelefono){
        $this->telefono = $newTelefono;
    } 

    //creo mi toString para retornar la info de la clase
    public function __toString (){
       return "Nombre: ".$this->getNombre()."\n"."Apellido: ".$this->getApellido()."\n"."DNI: ".$this->getNroDocumento()."\n"."Telefono: ".$this->getTelefono()."\n";
    }
   
}