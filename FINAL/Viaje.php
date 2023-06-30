<?php
include_once "Bdd.php";
//Creo la clase viaje
class Viaje {
    //Declaro sus atributos
    private $idviaje;
    private $responsableV;
    private $vcantmaxpasajeros;
    private $vdestino;
    private $vimporte;
    private $empresa;
    private $pasajeros;
    private $error;

    //creo el meotodo constructor de la clase
    public function __construct (){
        $this->idviaje = "";
        $this->responsableV = "";
        $this->vcantmaxpasajeros = "";
        $this->vdestino = "";
        $this->vimporte = "";
        $this->empresa = "";
        $this->pasajeros[]= new Pasajero();
        $this->error = "";

    }

    public function cargar($empresa, $empleado, $maxPas, $destino, $importe){
        $this->setResponsableV($empleado);
        $this->setVcantmaxpasajeros($maxPas);
        $this->setVdestino($destino);
        $this->setVimporte($importe);
        $this->setEmpresa($empresa);
    }

    //Creo metodos de acceso a los atributos
    public function getIdviaje (){
        return $this->idviaje;
    }

    public function getResponsableV (){
        return $this->responsableV;
    }

    public function getVcantmaxpasajeros (){
        return $this->vcantmaxpasajeros;
    }

    public function getVdestino (){
        return $this->vdestino;
    }

    public function getVimporte (){
        return $this->vimporte;
    }

    public function getPasajeros(){
        return $this->pasajeros;
    }

    public function getError(){
		return $this->error ;
	}

    public function getEmpresa(){
		return $this->empresa ;
	}

    //Creo metodos de seteo
    public function setIdViaje ($new){
        $this->idviaje = $new;
    }

    public function setResponsableV ($new){
        $this->responsableV = $new;
    }

    public function setVcantmaxpasajeros ($new){
        $this->vcantmaxpasajeros = $new;
    }

    public function setVdestino ($nuevo){
        $this->vdestino = $nuevo;
    }

    public function setVimporte ($nuevo){
        $this->vimporte = $nuevo;
    }

    public function setPasajeros($new){
        $this->pasajeros = $new;
    }

    public function setError ($error){
        $this->error = $error;
    }

    public function setEmpresa ($empresa){
        $this->empresa = $empresa;
    }

    public function cambiarResponsable($new){
        $this->setResponsableV($new);
    }

    public function cambiarCantidadMaxPasajeros($new){
        $this->setVcantmaxpasajeros($new);
    }
    
    public function cambiarDestino($new){
        $this->setVdestino($new);
    }

    public function cambiarImporte($new){
        $this->setVimporte($new);
    }

    public function cambiarEmpresa($new){
        $this->setEmpresa($new);
    }


    public function insertar (){
        $pudo = false;
        $base =  new Bdd ();
        $consulta = "INSERT INTO viaje (idempresa, rnumeroempleado, vcantmaxpasajeros, vdestino, vimporte) VALUES ('".$this->getEmpresa()->getIdempresa()."', '".$this->getResponsableV()->getRnumeroempleado()."', '".$this->getVcantmaxpasajeros()."', '".$this->getVdestino()."', '".$this->getVimporte()."')";
        if($base->iniciar()){
            if ($id = $base->devuelveIDInsercion($consulta)){
                $pudo = true;
                $this->setIdViaje($id);
		    }else{
		        $this->setError($base->getError());
		    }
		}else{
		    $this->setError($base->getError());
        }
        return $pudo;
    }

    public function buscar ($id){
		$base = new Bdd();
		$consulta="SELECT * FROM viaje WHERE idviaje=".$id;
		$pudo= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){
				    $this->setIdViaje($id);
                    $resp = new ResponsableV();
                    $resp->Buscar($row2['rnumeroempleado']);
					$maxPas = $row2['vcantmaxpasajeros'];
                    $destino = $row2['vdestino'];
					$importe = $row2['vimporte'];
                    $emp = new Empresa ();
                    $emp->buscar($row2['idempresa']);
                    $this->cargar($emp, $resp, $maxPas, $destino, $importe);
					$pudo = true;
				}				
			
		 	}else{
		 		$this->setError($base->getError());
		 		
			}
		}else{
		 	$this->setError($base->getError());
		}		
		return $pudo;
	}

    public function modificar(){
	    $resp =false; 
	    $base=new Bdd();
		$consulta="UPDATE viaje SET rnumeroempleado='".$this->getResponsableV()->getRnumeroempleado()."', vcantmaxpasajeros ='".$this->getVcantmaxpasajeros()."', vdestino = '".$this->getVdestino()."', vimporte ='".$this->getVimporte()."', idempresa = '".$this->getEmpresa()->getIdempresa()."' WHERE idviaje =".$this->getIdviaje();
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
			    $resp=  true;
			}else{
				$this->setError($base->getError());
				
			}
		}else{
			$this->setError($base->getError());
			
		}
		return $resp;
	}
 

    public function borrarDatos (){
        $pudo = false;
        $base =  new Bdd ();
        $consulta = "DELETE FROM viaje WHERE idviaje = ".$this->getIdviaje();
        if($base->iniciar()){
            if ($base->ejecutar($consulta) === TRUE) {
                $pudo=  true;
		    }else{
		        $this->setError($base->getError());
		    }
		}else{
		    $this->setError($base->getError());
        }
        return $pudo;
    }

    public function borrarDeEmpresa($id){
        $pudo = false;
        $viajes = $this->listar("idempresa = ".$id);
        $pas = $this->getPasajeros()[0];
        if ($viajes != null){
            for ($i=0; $i < count($viajes) ; $i++) { 
                //$viajes[$i]->getResponsableV()->borrarDatos();
                $pasajeros = Pasajero::listar("idviaje = ".$viajes[$i]->getIdviaje());
                if ($pasajeros != null){
                    for ($i=0; $i < count($pasajeros) ; $i++) { 
                        $pasajeros[$i]->borrarDatos();
                    }
                }
                $viajes[$i]->borrarDatos();
            }
            $pudo = true;     
        }
        
        return $pudo;
    }
    

    public function actualizarPas() {
        $arrayPas = null;
        $hay = false;
        $pasajero = $this->getPasajeros()[0];
        $arrayPas = $pasajero->listar("idviaje = ".$this->getIdviaje());
        if(count($arrayPas) != null){
            $this->setPasajeros($arrayPas);
            $hay = true;
        }
        return $hay;
    }

    public static function listar($condicion=""){
	    $arreglo = null;
		$base=new Bdd();
		$consulta="Select * from viaje ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new Viaje();
					$obj->setIdViaje($row2['idviaje']);
                    $resp = new ResponsableV();
                    $resp->Buscar($row2['rnumeroempleado']);
					$maxPas = $row2['vcantmaxpasajeros'];
                    $destino = $row2['vdestino'];
					$importe = $row2['vimporte'];
                    $emp = new Empresa ();
                    $emp->buscar($row2['idempresa']);
                    $obj->setIdViaje(($row2['idviaje']));
                    $obj->cargar($emp, $resp, $maxPas, $destino, $importe);
					array_push($arreglo,$obj);
				}
		 	}else {
		 		$this->setError($base->getError());
			}
		}else{
		 	$this->setError($base->getError());
		}	
		return $arreglo;
	}

    public function datosMinimos(){
        $informacion = "";
        $informacion = $informacion."El codigo del viaje es: ".$this->getIdviaje()."\n";
        $informacion = $informacion."El destino del viaje es: ".$this->getVdestino()."\n";
        $informacion = $informacion."Pasajeros actuales: ".(count(Pasajero::listar("idviaje = ".$this->getIdviaje())))." de ".$this->getVcantmaxpasajeros()."\n";
        return $informacion;
    }

    //creo un metodo para poder mostrar todos los datos del viaje.
    public function __toString(){
        $informacion = "";
        $informacion = $informacion."El viaje pertenece a la empresa: \n".$this->getEmpresa()."\n";
        $informacion = $informacion."-------\n";
        $informacion = $informacion."El responsable del Viaje es: \n".$this->getResponsableV()."\n";
        $informacion = $informacion."-------\n";
        $informacion = $informacion."El codigo del viaje es: ".$this->getIdviaje()."\n";
        $informacion = $informacion."El destino del viaje es: ".$this->getVdestino()."\n";
        $informacion = $informacion."La cantidad maxima de pasajeros es de: ".$this->getVcantmaxpasajeros()."\n";
        $informacion = $informacion."El costo del pasaje es de: ".$this->getVimporte()."\n\n";
        $informacion = $informacion."-------\n";
        $informacion = $informacion."El responsable del Viaje es: \n".$this->getResponsableV()."\n";
        $informacion = $informacion."-------\n";
        if ($this->actualizarPas()){
            $informacion = $informacion."La lista de los ".count($this->getPasajeros())." pasajeros es: \n"."\n";
            for ($i = 0; $i < count($this->getPasajeros ()); $i++) { 
                $informacion = $informacion."Pasajero ".($i+1).":\n".$this->getPasajeros ()[$i]."\n"."\n";
            }
        }else{
            $informacion = $informacion."El Viaje no tiene pasajeros.\n";  
        }
        return $informacion;
    }

}
