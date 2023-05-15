<?php
//Creo la clase viaje
class Viaje {
    //Declaro sus atributos
    private $codigoViaje;
    private $destino;
    private $cantidadPasajeros;
    private $datosPasajeros;
    private $responsable;
    private $costoViaje;
    private $totalAbonado;

    //creo el meotodo constructor de la clase
    public function __construct ($codigo, $destinoV, $cantPasajeros,$responsable, $costoViaje, $totalAbonado){
        $this->codigoViaje = $codigo;
        $this->destino = $destinoV;
        $this->cantidadPasajeros = $cantPasajeros;
        $this->datosPasajeros = []; //$datosPas;
        $this->responsable = $responsable;
        $this->costoViaje = $costoViaje;
        $this->totalAbonado = $totalAbonado;
        
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

    public function getResponsable (){
        return $this->responsable;
    }

    public function getCostoViaje (){
        return $this->costoViaje;
    }

    public function getTotalAbonado (){
        return $this->totalAbonado;
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

    public function setCostoViaje ($nuevo){
        $this->costoViaje = $nuevo;
    }

    public function setTotalAbonado ($nuevo){
        $this->totalAbonado = $nuevo;
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
            if (strcmp($dniPasajero,$this->getDatosPasajeros()[$i]->getNroDocumento ()) === 0){
                $arrayfunct [$i]->setNombre ($nuevoNombre);
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
            if (strcmp($dniPasajero,$this->getDatosPasajeros()[$i]->getNroDocumento ()) === 0){
                $fueEncontrado = true;
                $arrayfunct [$i]->setApellido ($nuevoApellido);
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

    //cambiar todos los datos de un pasajero
    public function cambiarPasajero ($dniPasajero, $nuevoNombre, $nuevoApellido, $nuevoDni, $nuevoTelefono){
        $fueEncontrado = false;
        $i = 0;
        $rta = "";
        $arrayfunct = $this->getDatosPasajeros();
        while ($i < count($this->getDatosPasajeros ()) && !$fueEncontrado) { 
            if (strcmp($dniPasajero,$this->getDatosPasajeros()[$i]->getNroDocumento ()) === 0){
                $fueEncontrado = true;
                $arrayfunct[$i]->setNombre ($nuevoNombre);
                $arrayfunct[$i]->setApellido ($nuevoApellido);
                $arrayfunct[$i]->setNroDocumento ($nuevoDni);
                $arrayfunct[$i]->setTelefono ($nuevoTelefono);
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

    public function hayPasajesDisponibles (){
        $puedo = null;
        if (($this->getCantidadPasajeros () - count($this->getDatosPasajeros ())) > 0 ) {
            $puedo = true;
        }
        else{
            $puedo = false;
        }
        return $puedo;
    }


    //metodo para vender un pasasje del viaje
    public function venderPasaje($pasajeroNuevo){
        $totalActual = getTotalAbonado();
            if ( $this->hayPasajesDisponibles() ) { 
                $datos = $this->getDatosPasajeros ();
                array_push ( $datos , $pasajeroNuevo);
                $this->setDatosPasajeros($datos);
                //array_push ($this->getDatosPasajeros () ); //no se puede usar?????
                $porc = $pasajeroNuevo->darPorcentajeIncremento();
                $importe = $porc * $this->getCostoViaje() / 100;
                $totalActual = $totalAbonado + $importe;
                setTotalAbonado ($totalActual);
            }
        return $importe;
    }

    //creo un metodo para poder mostrar todos los datos del viaje.
    public function __toString(){ 
        $informacion = "";
        $informacion = $informacion."El codigo del viaje es: ".$this->getCodigoViaje()."\n";
        $informacion = $informacion."El destino del viaje es: ".$this->getDestino()."\n";
        $informacion = $informacion."La cantidad maxima de pasajeros es de: ".$this->getCantidadPasajeros()."\n"."\n";
        $informacion = $informacion."El responsable del Viaje es: \n".$this->getResponsable()."\n";
        $informacion = $informacion."El costo del pasaje es de: \n".$this->getCostoViaje()."\n";
        $informacion = $informacion."El total recaudado del viaje es de: \n".$this->getTotalAbonado()."\n";
        $informacion = $informacion."La lista de los ".count($this->getDatosPasajeros ())." pasajeros es: \n"."\n";
        for ($i = 0; $i < count($this->getDatosPasajeros ()); $i++) { 
            $informacion = $informacion."Nombre: ".$this->getDatosPasajeros ()[$i]."\n"."\n";
        }
        return $informacion;
    }

}
