<?php
include_once "Bdd.php";
class Pasajero {
    private $nombre;
    private $apellido;
    private $nroDocumento;
    private $telefono;
    private $error;
    private $viaje;

    //creo el metodo constructor de mi clase
    public function __construct (){
        $this->nombre = "";
        $this->apellido = "";
        $this->nroDocumento = "";
        $this->telefono = "";
        $this->error = "";
        $this->viaje = null;
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
    
    public function getError(){
		return $this->error ;
	}

    public function getViaje(){
		return $this->viaje;
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

    public function setError ($error){
        $this->error = $error;
    }

    public function setViaje ($new){
        $this->viaje = $new;
    }

    public function cargar ($apellido, $nombre, $nroDocumento, $telefono, $viaje){
        $this->setApellido($apellido);
        $this->setNombre($nombre);
        $this->setNroDocumento($nroDocumento);
        $this->setTelefono($telefono);
        $this->setViaje($viaje);
    }

    public function cambiarNombre ($newNombre){
        $this->setNombre($newNombre);
    }

    public function cambiarApellido ($newApellido){
        $this->setApellido($newApellido);
    }

    public function cambiarTelefono ($newTelefono){
        $this->setTelefono($newTelefono);
    }
    
    public function insertar (){
        $pudo = false;
        $base =  new Bdd ();
        $consulta = "INSERT INTO pasajero (idviaje, papellido, pnombre, pdocumento, ptelefono) VALUES ('".$this->getViaje()->getIdviaje()."','".$this->getApellido()."', '".$this->getNombre()."', '".$this->getNroDocumento()."','".$this->getTelefono()."')";
        if($base->iniciar()){
            if ($base->ejecutar($consulta) === TRUE) {
                $pudo = true;
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
		$consulta="SELECT * FROM pasajero WHERE pdocumento=".$id;
		$pudo= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){
                    $viaje = new Viaje();
                    $viaje->buscar($row2['idviaje']);
                    $this->cargar($row2['papellido'], $row2['pnombre'], $id, $row2['ptelefono'], $viaje);
					$pudo = true;
				}				
			
		 	}else {
		 		$this->setError($base->getError());
		 		
			}
		}else{
		 	$this->setError($base->getError());
		}		
		return $pudo;
	}
    
    //poner los datos que correspondan al pasajero
    public function modificar(){
	    $resp =false; 
	    $base=new Bdd();
		$consulta="UPDATE pasajero SET papellido='".$this->getApellido()."', pnombre='".$this->getNombre()."'
                           , ptelefono ='".$this->getTelefono()."' WHERE pdocumento =".$this->getNroDocumento();
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
        $consulta = "DELETE FROM pasajero WHERE pdocumento = ".$this->getNroDocumento();
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

    /* public function borrarPasajerosDe ($idViaje){
        $base = new Bdd();
        $pudo = false;
        $consulta = "DELETE FROM pasajero WHERE idviaje = ".$idViaje;
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
    
    FUNCION DESCARTADA LUEGO DE LA ENTREGA, SE SUSTITUYE USANDO EL ELIMINAR DEL MOR
    
    
    */

    public static function listar($condicion=""){
	    $arreglo = null;
		$base=new Bdd();
		$consulta="Select * from pasajero ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
                    $obj=new Pasajero();
                    $viaje = new Viaje();
                    $viaje->buscar($row2['idviaje']);
                    $obj->cargar($row2['papellido'], $row2['pnombre'], $row2['pdocumento'], $row2['ptelefono'], $viaje);
					$pudo = true;
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
        return "Nombre: ".$this->getNombre()."\n"."Apellido: ".$this->getApellido()."\n"."DNI: ".$this->getNroDocumento()."\n"."Pasajero del viaje: ".$this->getViaje()->getIdviaje()."\n";
    }

    //creo mi toString para retornar la info de la clase
    public function __toString (){
       return "Nombre: ".$this->getNombre()."\n"."Apellido: ".$this->getApellido()."\n"."DNI: ".$this->getNroDocumento()."\n"."Telefono: ".$this->getTelefono()."\n";
    }
   
}