<?php

class Empresa {

    private $viajes;

    public function __construct ($viajes){
    
        $this->viajes = $viajes;
    }

    public function getViajes (){
        return $this->viajes;
    }

    public function setViajes ($newViajes){
        $this->viajes = $newViajes;
    }

    //Creo una funcion que me diga si el objeto viaje existe o no 
    /** 
    *@return INT
    */
    function existe ($codViaje){
        $i = 0;
        $band = true;
        $indice = -1;
        while (( $i < (count($this->getViajes()))) && $band ){
            $clave = $this->getViajes()[$i]->getCodigoViaje ();
            if (strcmp($clave, $codViaje) === 0){
                $band = false;
                $indice = $i;
            }
            $i++;
        }
        return $indice;
    }

    public function agregarViaje ($newViaje){
        $colViajes = $this->getViajes();
        array_push ($colViajes, $newViaje );
        $this->setViajes($colViajes);
    }

    public function __toString (){
        $i = 0;
        $rta = "Los viajes de la empresa son: \n";
        while ($i < (count($this->getViajes()))){
            $rta = $rta."Viaje ".($i+1).": \n".$this->getViajes()[$i];
            $i++;
        }
        return $rta;
    }
}


