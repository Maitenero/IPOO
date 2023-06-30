<?php
include_once "Bdd.php";
class ResponsableV {
    private $rapellido;
    private $rnombre;
    private $rnumeroempleado;
    private $rnumerolicencia;
    private $error;

    //Creo mi metodo constructor
    public function __construct (){
        $this->rnumeroempleado = "";
        $this->rnumerolicencia = "";
        $this->rnombre = "";
        $this->rapellido = "";
        $this->error = "";
    }

    //defino mis metodos de acceso
    public function getRnumeroempleado (){
        return $this->rnumeroempleado;
    }
    
    public function getRnumerolicencia (){
        return $this->rnumerolicencia;
    }

    public function getRnombre (){
        return $this->rnombre;
    }
    
    public function getRapellido (){
        return $this->rapellido;
    }

    public function getError(){
		return $this->error ;
	}
    
    //defino mis metodos de seteo
    public function setRnumeroempleado ($newrnumeroempleado){
        $this->rnumeroempleado = $newrnumeroempleado;
    }

    public function setRnrolicencia ($newrnumerolicencia){
        $this->rnumerolicencia = $newrnumerolicencia;
    } 

    public function setRnombre ($newrnombre){
        $this->rnombre = $newrnombre;
    }

    public function setRapellido ($newrapellido){
        $this->rapellido = $newrapellido;
    }

    public function setError ($error){
        $this->error = $error;
    }

    public function cargar ($rapellido, $rnombre, $rnumerolicencia){
        $this->setRapellido($rapellido);
        $this->setRnombre($rnombre);
        $this->setRnrolicencia($rnumerolicencia);
    }

    public function insertar (){
        $pudo = false;
        $base =  new Bdd ();
        $consulta = "INSERT INTO responsable (rapellido, rnombre, rnumerolicencia) VALUES ('".$this->getRapellido()."','".$this->getRnombre()."','".$this->getRnumerolicencia()."')";
        if($base->iniciar()){
            if ($id = $base->devuelveIDInsercion($consulta)){
                $pudo = true;
                $this->setRnumeroempleado($id);
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
		$consulta="SELECT * FROM responsable WHERE rnumeroempleado=".$id;
		$pudo= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){
				    $this->setRnumeroempleado($id);
                    $this->cargar($row2['rapellido'],$row2['rnombre'],$row2['rnumerolicencia']);
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

    public static function listar($condicion=""){
	    $arreglo = null;
		$base=new Bdd();
		$consulta="Select * from responsable";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new ResponsableV();
					$obj->setRnumeroempleado($row2['rnumeroempleado']);
                    $obj->cargar($row2['rapellido'],$row2['rnombre'],$row2['rnumerolicencia']);
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

    public function cambiarNombre ($new){
        $this->setRnombre($new);
    }

    public function cambiarApellido ($new){
        $this->setRapellido($new);
    }

    public function cambiarNroLicencia ($newNroLicencia){
        $this->setRnrolicencia($newNroLicencia);
    }

    public function modificar(){
	    $resp =false; 
	    $base=new Bdd();
		$consulta="UPDATE responsable SET rnombre='".$this->getRnombre()."', rapellido ='".$this->getRapellido()."' , rnumerolicencia ='".$this->getRnumerolicencia()."'WHERE rnumeroempleado =".$this->getRnumeroempleado();
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
        $consulta = "DELETE FROM responsable WHERE rnumeroempleado = ".$this->getRnumeroempleado(); 
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
     
    public function datosMinimos(){
        return "Nombre: ".$this->getRnombre()."\nApellido: ".$this->getRapellido()."\n"."Nro Empleado: ".$this->getRnumeroempleado()."\n"."Viajes a cargo: ".(count(Viaje::listar("rnumeroempleado = ".$this->getRnumeroempleado())))."\n";
    }

    //defino mi metodo toString
    public function __toString (){
        return "Nombre: ".$this->getRnombre()."\n"."Apellido: ".$this->getRapellido()."\n"."Nro Empleado: ".$this->getRnumeroempleado()."\n"."Nro Licencia: ".$this->getRnumerolicencia()."\n";
    }
    
}