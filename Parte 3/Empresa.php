<?php

class Empresa {

    private $viajes;
    private $pasajeros;

    public function __construct ($viajes, $pasajeros){
    
        $this->viajes = $viajes;
        $this->pasajeros = $pasajeros;
    }

    public function getViajes (){
        return $this->viajes;
    }

    public function getPasajeros (){
        return $this->pasajeros;
    }

    public function setViajes ($newViajes){
        $this->viajes = $newViajes;
    }

    public function setPasajeros ($newPasajeros){
        $this->pasajeros = $newPasajeros;
    }

    public function darPorcentajeIncremento ($pasajero){
        $porcentaje = null;
        if($pasajero instanceof Pasajero){
            $porcentaje = 10;
        }
        elseif ($pasajero instanceof PasajeroVip){
            if ($pasajero->getMillas()>300){
                $porcentaje = 30;
            }
            else {
                $porcentaje = 35;
            }
        }
        elseif ($pasajero instanceof PasajeroEsp){
            if (count($pasasajero->getNecesidades()) > 1){
                $porcentaje = 30;
            }
            else{
                $porcentaje = 15;
            }
        }
        return $porcentaje;     
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

    public function agregarPasajero ($newPasajero){
        $colPas = [];
        $colPas = $this->getPasajeros();
        array_push($colPas, $newPasajero);
        $this->setPasajeros($colPas);
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