<?php
class ResponsableV {
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;

    //Creo mi metodo constructor
    public function __construct ($nroEmpleado, $nroLicencia, $nombre, $apellido){
        $this->nroEmpleado = $nroEmpleado;
        $this->nroLicencia = $nroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    //defino mis metodos de acceso
    public function getNroEmpleado (){
        return $this->nroEmpleado;
    }
    
    public function getNroLicencia (){
        return $this->nroLicencia;
    }

    public function getNombre (){
        return $this->nombre;
    }
    
    public function getApellido (){
        return $this->apellido;
    }
    
    //defino mis metodos de seteo
    public function setNroEmpleado ($newNroEmpleado){
        $this->nroEmpleado = $newNroEmpleado;
    }

    public function setNroDcoumento ($newNroLicencia){
        $this->nroLicencia = $newNroLicencia;
    } 

    public function setNombre ($newNombre){
        $this->nombre = $newNombre;
    }

    public function setApellido ($newApellido){
        $this->apellido = $newApellido;
    }
     
    //defino mi metodo toString
    public function __toString (){
        return "Nombre: ".$this->getNombre()."\n"."Apellido: ".$this->getApellido()."\n"."Nro Empleado: ".$this->getNroEmpleado()."\n"."Nro Licencia: ".$this->getNroLicencia()."\n";
    }
    
}