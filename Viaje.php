<?php
//Creo la clase viaje
class Viaje {
    //Declaro sus atributos
    private $codigoViaje;
    private $destino;
    private $cantidadPasajeros;
    private $datosPasajeros;

    //creo el meotodo constructor de la clase
    public function __construct ($codigo, $destinoV, $cantPasajeros, $datosPas){
        //if (count($datosPas) <= $cantPasajeros){//PREGUNTTARRRRRR------------------------- CANCELADO PQ LO VALIDO EN OTRO LADO
        $this->codigoViaje = $codigo;
        $this->destino = $destinoV;
        $this->cantidadPasajeros = $cantPasajeros;
        $this->datosPasajeros = $datosPas;
        //}
        //else {
           // echo "No puede crearse el viaje debido a la cantidad de pasajeros exede el maximo posible. \n";
            //echo "\n";
       // }
    }

    //Creo metodos de acceso a los atributos 
    public function getCodigoViaje (){
        return $this->codigoViaje;
    }

    public function getDestino (){
        return $this->destino;
    }

    public function getCantidadPasajeros (){
        return $this->cantidadPasajeros;
    }

    public function getDatosPasajeros (){
        return $this->datosPasajeros;
    }

    //Creo metodos de seteo
    public function setCodigoViaje ($nuevoCodigo){
        $this->codigoViaje = $nuevoCodigo;
    }

    public function setDestino ($nuevoDestino){
        $this->destino = $nuevoDestino;
    }

    public function setDatosPasajeros ($nuevosDatos){
        $this->datosPasajeros = $nuevosDatos;
    }

    public function setCantidadPasajeros ($nuevaCantPasajeros){
        $this->cantidadPasajeros = $nuevaCantPasajeros;
    }

    //Creo un metodo que permite modificar el Codigo del viaje
    public function cambiarCodigo ($newCodigo){
        $this->setCodigoViaje($newCodigo);
    } 

    //Creo un metodo que permite modificar el destino del viaje
    public function cambiarDestino ($newDestino){
        $this->setDestino($newDestino);
    } 

    //Creo un metodo que permite modificar la cantidad de pasajerosecho "\n";
    public function cambiarCantPasajeros ($newCantPas){
        $this->setCantidadPasajeros($newCantPas);
    } 

    //Creo un metodo para modificar dni de los pajeros
    public function cambiarNombrePas  ($dniPasajero, $nuevoNombre){
        $i = 0;
        $rta = ""; //es valido usar una misma variable en todos los metodos? nunca se usan dos metodos al mismo tiempo no deberia tener conflicto, y no creo variables en exeso al usar solo una, dudasssssss
        $fueEncontrado = false;
        $arrayfunct = $this->getDatosPasajeros();
        while ($i < count($this->getDatosPasajeros ()) && !$fueEncontrado) { 
            if (strcmp($dniPasajero,$this->getDatosPasajeros()[$i]["DNI"]) === 0){
                $arrayfunct [$i]["Nombre"] = $nuevoNombre;
                $rta = "El cambio se realizo con exito. \n"."\n";
                $fueEncontrado = true;
                $this->setDatosPasajeros ($arrayfunct);
            }
            $i++;
        }
        if (!$fueEncontrado) {
            $rta = "No se encontro el pasajero con el DNI: ".$dniPasajero." \n"."\n";
        }
        return $rta;
    }

     //Creo un metodo para modificar el apellido de los pajeros
     public function cambiarApellidoPas  ($dniPasajero, $nuevoApellido){
        $fueEncontrado = false;
        $i = 0;
        $rta = "";
        $arrayfunct = $this->getDatosPasajeros();
        while ($i < count($this->getDatosPasajeros ()) && !$fueEncontrado) { 
            if (strcmp($dniPasajero,$this->getDatosPasajeros ()[$i]["DNI"]) === 0){
                $fueEncontrado = true;
                $arrayfunct [$i]["Apellido"] = $nuevoApellido;
                $rta = "El cambio se realizo con exito. \n"."\n";
                $this->setDatosPasajeros ($arrayfunct);
            }
            $i++;
        }
        if (!$fueEncontrado){
            $rta = "El cambio no pudo realizarse, es posible que el DNI del pasajero a modificar no sea valido, vuelva a intentarlo. \n"."\n";
        }
        return $rta;
    }

     //Creo un metodo para modificar el DNI de los pajeros
     public function cambiarDniPas  ($dniPasajero, $nuevoDni){
        $fueEncontrado = false;
        $i = 0;
        $rta = "";
        $arrayfunct = $this->getDatosPasajeros();
        while ($i < count($this->getDatosPasajeros ()) && !$fueEncontrado) { 
            if (strcmp($dniPasajero,$this->getDatosPasajeros ()[$i]["DNI"]) === 0){
                $fueEncontrado = true;
                $arrayfunct[$i]["DNI"] = $nuevoDni;
                $rta = "El cambio se realizo con exito. \n"."\n";
                $this->setDatosPasajeros ($arrayfunct);
            }
            $i++;
        }
        if (!$fueEncontrado){
            $rta = "El cambio no pudo realizarse, es posible que el DNI del pasajero a modificar no sea valido, vuelva a intentarlo. \n"."\n";
        }
        return $rta;
    }

    public function cambiarPasajero ($dniPasajero, $nuevoNombre, $nuevoApellido, $nuevoDni){
        $fueEncontrado = false;
        $i = 0;
        $rta = "";
        $arrayfunct = $this->getDatosPasajeros();
        while ($i < count($this->getDatosPasajeros ()) && !$fueEncontrado) { 
            if (strcmp($dniPasajero,$this->getDatosPasajeros ()[$i]["DNI"]) === 0){
                $fueEncontrado = true;
                $arrayfunct[$i]["Nombre"] = $nuevoNombre;
                $arrayfunct[$i]["Apellido"] = $nuevoApellido;
                $arrayfunct[$i]["DNI"] = $nuevoDni;
                $rta = "El cambio se realizo con exito. \n"."\n";
                $this->setDatosPasajeros ($arrayfunct);
            }
            $i++;
        }
        if (!$fueEncontrado){
            $rta = "El cambio no pudo realizarse, es posible que el DNI del pasajero a modificar no sea valido, vuelva a intentarlo. \n"."\n";
        }
        return $rta;
    }

    public function agregarPasajero ($nuevoNombre, $nuevoApellido, $nuevoDni){
        $rta = "";
        if (($this->getCantidadPasajeros () - count($this->getDatosPasajeros ())) > 0 ) { 
            $datos = $this->getDatosPasajeros ();
            $new = count ($this->getDatosPasajeros ());
            array_push ( $datos , ["Nombre"=>$nuevoNombre, "Apellido"=> $nuevoApellido, "DNI"=>$nuevoDni]);
            $this->setDatosPasajeros($datos);
            //array_push ($this->getDatosPasajeros () ); //no se puede usar?????
            $rta = "El pasajero se agrego con exito. \n"."\n";
            
        }
        else {
            $rta = "No se puede agregar el pasajero debido a que el viaje llego a su capacidad maxima. \n"."\n";
        }
        return $rta;
    }

    //creo una funcion para poder mostrar todos los datos del viaje.
    public function __toStrign(){ 
        $informacion = "";
        $informacion = $informacion."El codigo del viaje es: ".$this->getCodigoViaje()."\n";
        $informacion = $informacion."El destino del viaje es: ".$this->getDestino()."\n";
        $informacion = $informacion."La cantidad maxima de pasajeros es de: ".$this->getCantidadPasajeros()."\n";
        $informacion = $informacion."La lista de los ".count($this->getDatosPasajeros ())." pasajeros es: \n"."\n";
        for ($i = 0; $i < count($this->getDatosPasajeros ()); $i++) { 
            $informacion = $informacion."Nombre: ".$this->getDatosPasajeros ()[$i]["Nombre"]."\n"."Apellido: ".$this->getDatosPasajeros ()[$i]["Apellido"]."\n"."DNI: ".$this->getDatosPasajeros ()[$i]["DNI"]."\n"."\n";
        }
        return $informacion;
    }

}
