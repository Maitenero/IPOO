<?php
include_once "Bdd.php";
class Empresa {
    private $idempresa;
    private $enombre;
    private $edireccion;
    private $error;

    public function __construct (){
        $this->idempresa = "";
        $this->enombre = "";
        $this->edireccion = "";
        $this->error = "";
    }

    public function getIdempresa(){
        return $this->idempresa;
    }

    public function getEnombre(){
        return $this->enombre;
    }

    public function getEdireccion(){
        return $this->edireccion;
    }

	public function getError(){
		return $this->error ;
	}

    public function setIdempresa($new){
        $this->idempresa = $new;
    }

    public function setEnombre($new){
        $this->enombre = $new;
    }

    public function setEdireccion($new){
        $this->edireccion = $new;
    }

    public function setError ($error){
        $this->error = $error;
    }

    public function cargar ( $enombre, $edireccion){
        $this->setEnombre($enombre);
        $this->setEdireccion($edireccion);
    }

    public function cambiarNombre ($newNombre){
        $this->setEnombre($newNombre);
    }

    public function cambiarDireccion($new){
        $this->setEdireccion($new);
    }

    public function insertar(){
        $pudo = false;
        $base =  new Bdd ();
        $consulta = "INSERT INTO empresa (edireccion, enombre) VALUES ('".$this->getEdireccion()."','".$this->getEnombre()."')";
        if($base->iniciar()){
            if ($id = $base->devuelveIDInsercion($consulta)) {
                $pudo = true;
                $this->setIdempresa($id);
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
		$consulta="SELECT * FROM empresa WHERE idempresa=".$id;
		$pudo= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){
				    $this->setIdempresa($id);
                    $this->cargar($row2['enombre'],$row2['edireccion']);
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
		$consulta="UPDATE empresa SET enombre='".$this->getEnombre()."', edireccion ='".$this->getEdireccion()."'WHERE idempresa =".$this->getIdempresa();
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

    public static function listar($condicion=""){
	    $arreglo = null;
		$base=new Bdd();
		$consulta="Select * from empresa ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new Empresa();
					$obj->setIdempresa($row2['idempresa']);
                    $obj->cargar($row2['enombre'],$row2['edireccion']);
					array_push($arreglo,$obj);
				}
		 	}	else {
		 			$this->setError($base->getError());
			}
		}else{
		 	$this->setError($base->getError());
		}	
		return $arreglo;
	}


    public function borrarDatos (){
        $pudo = false;
        $base =  new Bdd ();
        $consulta = "DELETE FROM empresa WHERE idempresa = ".$this->getIdempresa();
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
        $cad = "";
        $cad = $cad."Nombre Empresa: ".$this->getEnombre()."\n";
        $cad = $cad."Id Empresa: ".$this->getIdempresa()."\n";
        $cad = $cad."Viajes actuales: ".(count(Viaje::listar("idempresa = ".$this->getIdempresa())))."\n";
        return $cad;
    }

    public function __toString(){
        $cad = "";
        $cad = $cad."Nombre Empresa: ".$this->getEnombre()."\n";
        $cad = $cad."Id Empresa: ".$this->getIdempresa()."\n";
        $cad = $cad."Direccion: ".$this->getEdireccion()."\n";
        return $cad;
    }
}