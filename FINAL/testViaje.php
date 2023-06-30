<?php
include_once('Bdd.php');
include_once('Empresa.php');
include_once('ResponsableV.php');
include_once('Viaje.php');
include_once('Pasajero.php');

/*
* Por cada Id hay que agregar el objeto en la clase correspondiente. LISTO
* Se deben respetar las operaciones del ABM en el MOR -> insertar, modificar,eliminar, buscar, listar CREO QUE LISTO
* Al cargar un viaje, verificar que el responsable puede ya existir LISTO
* Al cargar un pasajero verificar que no exista. LISTO
* Al eliminar usar el MOR LISTO
* Crear funcion para crearEmpresa() que retorne la empresa creada LISTO
* Modificar funciones de modificar para poder usarlas enviando el array o dato que yo quiera o sin enviar nada LISTO
* Crear funcion cargarSiNo LISTO
*/

//Funcion para cargar datos numericos
/*
@return INT
*/
function cargarNumerico (){
    $numero = trim(fgets(STDIN));
    $fin = true;
    do{
        if (!is_numeric($numero)){
            echo "-----------------------------------------------------------------------\n";
            echo "Ingrese el dato de forma correcta (usando numeros): \n";
            $numero = trim(fgets(STDIN));
        }
        else{
            $fin = false;
        }
    }while($fin);
    return $numero;
}

function cargarSiNo (){
    $siNo = trim(fgets(STDIN));
    $fin = false;
    do{
        strtolower($siNo);
        if ($siNo == "si" || $siNo == "no" ){
            $fin = true;
        }
        else{
            echo "Ingrese Si o No: \n";
            $siNo = trim(fgets(STDIN));
        }
    }while(!$fin);
    return $siNo;
}

//funcion para cargar un id valido
function idExistente ($seleccion){
    $band = 0;
    $valido = false;
    switch ($seleccion) {
        case 'p':
            $obj = new Pasajero();
            $seleccion = "dni de pasajero ";
            break;
        case 'r':
            $obj = new ResponsableV();
            $seleccion = "id de responsable ";
            break;
        case 'v':
            $obj = new Viaje();
            $seleccion = "id de viaje ";
            break;
        case 'e':
            $obj = new Empresa();
            $seleccion = "id de empresa ";
            break;
    }
    do{
        if($band > 0){
            echo "Id: ";
        }
        $id = cargarNumerico();
        if($obj->Buscar($id)){
            $valido = true;
        }else{
            echo "------------------------------------------------------------\n";
            echo "Seleccione un ".$seleccion."existente. \n";
            echo "------------------------------------------------------------\n";
            echo "Dese volver a ingresar un id? Si/No \n";
            $resp = cargarSiNo();
            if($resp == "no"){
                $valido = true;
                $obj = null;
            }
        }
        $band++;
    }while(!$valido);

    return $obj;
}

function verExistentes ($seleccion){
    $hay = false;
        switch ($seleccion) {
            case "p":
                $array = Pasajero::listar();
                $seleccion = "pasajeros. \n";
                break;
            case "r":
                $array = ResponsableV::listar();
                $seleccion = "responsables. \n";
                break;
            case "v":
                $array = Viaje::listar();
                $seleccion = "viajes. \n";
                break;
            case "e":
                $array = Empresa::listar();
                $seleccion = "empresas. \n";
                break;
        }
    if( $array != null ){
        $hay = true;
        for ($i=0; $i < count($array) ; $i++) { 
            echo "---------------------------------------------------\n";
            echo $array[$i]->datosMinimos();
            echo "---------------------------------------------------\n";
        }
    }else{
        echo "-----------------------------------------------------------------------\n";
        echo "No Existen ".$seleccion;
        echo "-----------------------------------------------------------------------\n";
    }
    return $hay;
}

function modificarPasajero (){
    $huboCambios = false;
    echo "Pasajeros Existentes: \n";
    if (verExistentes("p")){
        echo "Ingrese el id del Pasajero a Modificar. \n";
        $objAModificar = idExistente("p");
        if($objAModificar != null){
            echo "Desea cambiar el Apellido del Pasajero? Si/No \n";
            $opcion = cargarSiNo();
            if($opcion === "si"){
                echo "Ingrese el nuevo apellido:\n";
                $ap = cargarLetras();
                $objAModificar->cambiarApellido($ap);
                $huboCambios = true;
            }
            echo "Desea cambiar el Nombre del Pasajero? Si/No \n";
            $opcion = cargarSiNo();
            if($opcion === "si"){
                echo "Ingrese el nuevo nombre:\n";
                $nom = cargarLetras();
                $objAModificar->cambiarNombre($nom);
                $huboCambios = true;
            }
            echo "Desea cambiar el Telefono del Pasajero? Si/No \n";
            $opcion = cargarSiNo();
            if($opcion === "si"){
                echo "Ingrese el nuevo telefono:\n";
                $tel = cargarNumerico();
                $objAModificar->cambiarTelefono($tel);
                $huboCambios = true;
            }
            if($huboCambios){
                if ($objAModificar->modificar()){
                echo "-----------------------------------------------------------------------\n";
                echo "Los cambios se han aplicado correctamente. \n";
                echo "-----------------------------------------------------------------------\n";
                }else{
                echo "-----------------------------------------------------------------------\n";
                echo "Ha courrido un error en la modificacion de los datos ".$objAModificar->getError()."\n";
                echo "-----------------------------------------------------------------------\n";
                }
            }else{
                echo "-----------------------------------------------------------------------\n";
                echo "Usted no realizo ninguna modificacion sobre el pasajero. \n";
                echo "-----------------------------------------------------------------------\n";
            }
        }
    }
}


function modificarResponsable ($objAModificar = null){
    $huboCambios = false;
    $sigue = false;
    if($objAModificar != null){
        $sigue = true;
    }elseif($objAModificar == null){
        echo "Responsables Existentes: \n";
        verExistentes("r");
        echo "Ingrese el id del Responsable a Modificar. \n";
        $objAModificar = idExistente("r");
        if($objAModificar != null){
            $sigue = true;
        }else{
            echo "----------------------------------------------------\n";
            echo "Usted no selecciono un id valido.\n";
            echo "----------------------------------------------------\n";
        }
    }
    if ($sigue){
        echo "Desea cambiar el Apellido del Responsable? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            echo "Ingrese el nuevo apellido:\n";
            $ap = cargarLetras();
            $objAModificar->cambiarApellido($ap);
            $huboCambios = true;
        }
        echo "Desea cambiar el Nombre del Pasajero? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            echo "Ingrese el nuevo nombre:\n";
            $nom = cargarLetras();
            $objAModificar->cambiarNombre($nom);
            $huboCambios = true;
        }
        echo "Desea cambiar el numero de licencia del Responsable? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            echo "Ingrese el nuevo numero de licencia:\n";
            $lic = cargarNumerico();
            $objAModificar->cambiarNroLicencia($lic);
            $huboCambios = true;
        }
        if($huboCambios){
            if ($objAModificar->modificar()){
                echo "-----------------------------------------------------------------------\n";
                echo "Los cambios se han aplicado correctamente. \n";
                echo "-----------------------------------------------------------------------\n";
            }else{
                echo "-----------------------------------------------------------------------\n";
                echo "Ha courrido un error en la modificacion de los datos ".$objAModificar->getError()."\n";
                echo "-----------------------------------------------------------------------\n";
            }
        }else{
            echo "-----------------------------------------------------------------------\n";
            echo "Usted no realizo ninguna modificacion sobre el responsable. \n";
            echo "-----------------------------------------------------------------------\n";
        }
    }

}

function modificarEmpresa ($objAModificar = null){
    $huboCambios = false;
    $sigue = false;
    if($objAModificar != null){
        $sigue = true;
    }elseif($objAModificar == null){
        echo "Empresas Existentes: \n";
        verExistentes("e");
        echo "Ingrese el id de la empresa a Modificar. \n";
        $objAModificar = idExistente("e");
        if($objAModificar != null){
            $sigue = true;
        }else{
            echo "----------------------------------------------------\n";
            echo "Usted no selecciono un id valido.\n";
            echo "----------------------------------------------------\n";
        }
    }
    if ($sigue){
        echo "Desea cambiar el Nombre de la Empresa? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            echo "Ingrese el nuevo Nombre:\n";
            $nom = cargarLetras();
            $objAModificar->cambiarNombre($nom);
            $huboCambios = true;
        }
        echo "Desea cambiar la Direccion de la Empresa? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            echo "Ingrese la nueva direccion:\n";
            $dire = trim(fgets(STDIN));
            $objAModificar->cambiarDireccion($dire);
            $huboCambios = true;
        }
        if($huboCambios){
            if ($objAModificar->modificar()){
                echo "-----------------------------------------------------------------------\n";
                echo "Los cambios se han aplicado correctamente. \n";
                echo "-----------------------------------------------------------------------\n";
            }else{
                echo "-----------------------------------------------------------------------\n";
                echo "Ha courrido un error en la modificacion de los datos ".$objAModificar->getError()."\n";
                echo "-----------------------------------------------------------------------\n";
            }
        }else{
            echo "-----------------------------------------------------------------------\n";
            echo "Usted no realizo ninguna modificacion sobre la Empresa. \n";
            echo "-----------------------------------------------------------------------\n";
        }
    }

}

function modificarViaje ($objAModificar = null){
    $huboCambios = false;
    $sigue = false;
    if($objAModificar != null){
        $sigue = true;
    }elseif($objAModificar == null){
        echo "Viajes Existentes: \n";
        verExistentes("v");
        echo "Ingrese el id del viaje a modificar. \n";
        $objAModificar = idExistente("v");
        if($objAModificar != null){
            $sigue = true;
        }else{
            echo "-----------------------------------------------------------------------\n";
            echo "No se pudo realizar el cambio debido a que no selecciono un id valido. \n";
            echo "-----------------------------------------------------------------------\n";
        }
    }
    if ($sigue){
        echo "Desea cambiar o modificar el Responsable del Viaje? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            $corta = false;
            do{
            echo "1. Cambiar Responsable por uno nuevo.\n";
            echo "2. Cambiar Responsable por uno existente.\n";
            echo "3. Modificar datos del responsable actual.\n";
            echo "Ingrese opcion: ";
            $opcionNum = cargarNumerico();
            if($opcionNum == 1 || $opcionNum == 2 || $opcionNum == 3){
                $corta = true;
            }else{
                echo "-----------------------------------------------------------------------\n";
                echo "Seleccione una opcion valida. \n";
                echo "-----------------------------------------------------------------------\n";
            }
            }while(!$corta);
            switch ($opcionNum) {
                case 1:
                    $resp = crearResponsable();
                    if ($resp != null){
                        $objAModificar->cambiarResponsable($resp);
                        $huboCambios = true;
                    }else{
                        echo "----------------------------------------------------------------------------------------\n";
                        echo "No pudo realizarse el cambio debido a que no se creo el responsable de manera correcta. \n";
                        echo "----------------------------------------------------------------------------------------\n";
                    }
                    break;
                case 2:
                    verExistentes("r");
                    echo "Seleccione el id del Nuevo Responsable. \n";
                    $resp = idExistente("r");
                    if ($resp != null){
                        $objAModificar->cambiarResponsable($resp);
                        $huboCambios = true;
                    }else{
                        echo "-----------------------------------------------------------------------\n";
                        echo "No pudo realizarse el cambio debido a que no selecciono un id valido. \n";
                        echo "-----------------------------------------------------------------------\n";
                    }
                    break;
                case 3:
                    modificarResponsable($objAModificar->getResponsable());
                    $huboCambios = true;
                    break;
            }
        }
        echo "Desea cambiar el numero maximo de pasajeros? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            echo "Ingrese el nuevo numero maximo:\n";
            $max = cargarNumerico();
            $pasViaje = Pasajero::listar("idviaje =".$objAModificar->getIdviaje());
            if( $max > count($pasViaje)){
                $objAModificar->cambiarCantidadMaxPasajeros($max);
                $huboCambios = true;
                echo "Cambio realizado. \n";
            }else{
                echo "-----------------------------------------------------------------------\n";
                echo "No pueden haber mas pasajeros que asientos. \n";
                echo "-----------------------------------------------------------------------\n";
            } 
        }
        echo "Desea cambiar el destino del viaje? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            echo "Ingrese el nuevo destino:\n";
            $dest = cargarLetras();
            $objAModificar->cambiarDestino($dest);
            $huboCambios = true;
        }
        echo "Desea cambiar el importe del viaje? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            echo "Ingrese el nuevo nombre:\n";
            $imp = cargarNumerico();
            $objAModificar->cambiarImporte($imp);
            $huboCambios = true;
        }
        echo "Desea cambiar o modificar la empresa relacionada? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            $corta = false;
            do{
            echo "1. Cambiar la Empresa por una nueva.\n";
            echo "2. Cambiar la empresa por una existente.\n";
            echo "3. Modificar datos de la empresa actual.\n";
            echo "Ingrese opcion: ";
            $opcionNum = cargarNumerico();
            if($opcionNum == 1 || $opcionNum == 2 || $opcionNum == 3){
                $corta = true;
            }else{
                echo "-----------------------------------------------------------------------\n";
                echo "Seleccione una opcion valida. \n";
                echo "-----------------------------------------------------------------------\n";
            }
            }while(!$corta);
            switch ($opcionNum) {
                case 1:
                    $emp = crearEmpresa();
                    if ($emp != null){
                        $objAModificar->cambiarEmpresa($emp);
                        $huboCambios = true;
                    }else{
                        echo "-------------------------------------------------------------------------------------\n";
                        echo "No pudo realizarse el cambio debido a que no se creo la empresa de manera correcta. \n";
                        echo "-------------------------------------------------------------------------------------\n";
                    }
                    break;
                case 2:
                    verExistentes("e");
                    echo "Seleccione el id del la nueva empresa. \n";
                    $emp = idExistente("e");
                    if($emp != null){
                        $objAModificar->cambiarEmpresa($emp);
                        $huboCambios = true;
                    }else{
                        echo "-----------------------------------------------------------------------\n";
                        echo "No pudo realizarse el cambio debido a que no selecciono un id valido. \n";
                        echo "-----------------------------------------------------------------------\n";
                    }
                    break;
                case 3:
                    modificarEmpresa($objAModificar->getEmpresa());
                    $huboCambios = true;
                    break;
            }
        }
        if($huboCambios){
            if ($objAModificar->modificar()){
                echo "-----------------------------------------------------------------------\n";
                echo "Los cambios se han aplicado correctamente. \n";
                echo "-----------------------------------------------------------------------\n";
            }else{
                echo "----------------------------------------------------------------------------\n";
                echo "Ha ocurrido un error en la modificacion de los datos ".$objAModificar->getError()."\n";
                echo "----------------------------------------------------------------------------\n";
            }
        }else{
            echo "-----------------------------------------------------------------------\n";
            echo "Usted no realizo ninguna modificacion sobre el Viaje. \n";
            echo "-----------------------------------------------------------------------\n";
        }
    }

}

//Funcion para crear una Empresa
function crearEmpresa(){
    echo "Ingrese el nombre de la empresa: ";
    $nom = cargarLetras();
    echo "\n";
    echo "Ingrese La direccion de la empresa: ";
    $dire = trim(fgets(STDIN));
    echo "\n";
    $emp = new Empresa ();
    $emp->cargar($nom, $dire);
    if($emp->insertar()){
        echo "Los cambios se realizaron con exito. \n";
        echo "Desea agregar un Viaje a la empresa? Si/No \n";
        $opcion = cargarSiNo();
        while($opcion === "si"){
            crearViaje($emp);
            echo "Desea agregar otro Viaje? Si/No \n";
            $opcion = cargarSiNo();
        }
    }else{
        echo "-----------------------------------------------------------------------\n";
        echo "Ocurrio un error ".$emp->getError();
        echo "-----------------------------------------------------------------------\n";
        $emp = null;
    }
    return $emp;
}

//funcion para crear un Responsable del viaje
function crearResponsable (){
    $resp = new ResponsableV(); 
    echo "Ingrese los datos del Responsable del Viaje. \n";
    echo "\n";
    echo "Ingrese el numero de Licencia: ";
    $nroLic = cargarNumerico();
    echo "\n";
    echo "Ingrese el nombre del Responsable: ";
    $nom = cargarLetras();
    echo "\n";
    echo "Ingrese el apellido del Responable: ";
    $ap = cargarLetras();
    echo "\n";
    $resp->cargar($ap, $nom, $nroLic);
    if(!($resp->insertar())){
        $resp = null;
    }else{
        echo "-----------------------------------------------------------------------\n";
        echo "El responsable se creo correctamente. \n";
        echo "-----------------------------------------------------------------------\n";
    }
    return $resp;
}

//funcion para crear un Viaje
function crearViaje ($empre = null){
    $continua = false;
    if($empre == null){
        echo "Su viaje corresponde a una empresa existente? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            verExistentes("e");
            echo "Seleccione el id de la Empresa que desea. \n";
            $empre = idExistente("e");
            if($empre != null){
                $continua = true;
            }else{
                echo "-----------------------------------------------------------------------\n";
                echo "No se pudo realizar el cambio debido a que no selecciono un id valido. \n";
                echo "-----------------------------------------------------------------------\n";
            }
        }else{
            $empre = crearEmpresa();
            if($empre != null){
                $continua = true;
            }else{
                echo "----------------------------------------------------------------------------\n";
                echo "No se puede continuar cambio debido a que no creo la empresa correctamente. \n";
                echo "----------------------------------------------------------------------------\n";
            }
        }
    }else{
        $continua = true;
    }
    if($continua){
        echo "El responsable del viaje ya esta cargado? Si/No \n";
        $opcion = cargarSiNo();
        if($opcion === "si"){
            verExistentes("r");
            echo "Seleccione el id del responsable que desea. \n";
            $enc = idExistente("r");
            if($enc == null){
                echo "-----------------------------------------------------------------------\n";
                echo "No se pudo realizar el cambio debido a que no selecciono un id valido. \n";
                echo "-----------------------------------------------------------------------\n";
                $continua = false;
            }
        }else{
            $enc = crearResponsable();
        }
        if ($continua){
            echo "Ingrese el destino: ";
            $dest = cargarLetras();
            echo "\n";
            echo "Ingrese el maximo de pasajeros: ";
            $max = cargarNumerico();
            echo "\n";
            echo "Ingrese el importe: ";
            $imp = cargarNumerico();
            echo "\n";
            $viaj = new Viaje ();
            $viaj->cargar($empre, $enc, $max, $dest, $imp);
            if($viaj->insertar()){
                echo "Los cambios se realizaron con exito. \n";
                echo "\n";
                echo "Desea agregar pasajeros al viaje? Si/No \n";
                $opcion = cargarSiNo();
                while ($opcion === "si"){
                    crearPasajero($viaj);
                    echo "Desea agregar otro pasajero? Si/No \n";
                    $opcion = cargarSiNo();
                }
            }else{
                echo "-----------------------------------------------------------------------\n";
                echo "Ocurrio un error ".$empre->getError();
                echo "-----------------------------------------------------------------------\n";
            }
        }
    }
}

//funcion para crear un Pasajero
function crearPasajero($viaje = null){
    $pas = null;
    $continua = false;
    if($viaje == null){
        echo "Seleccione el viaje al que pertenece el pasajero. \n";
        verExistentes("v");
        echo "Seleccione el id del viaje correspondiente. \n";
        $viaje = idExistente("v");
        if($viaje != null){
            $continua = true;
        }else{
            echo "----------------------------------------------------\n";
            echo "Usted no selecciono un id valido.\n";
            echo "----------------------------------------------------\n";
        }
    }else{
        $continua = true;
    }
    $pasViaje = Pasajero::listar("idviaje =".$viaje->getIdviaje());
    if(($viaje->getVcantmaxpasajeros()) > (count($pasViaje))){
        if($continua){
            echo "Ingrese los datos del pasajero. \n";
            echo "\n";
            echo "Ingrese el nombre: ";
            $nom = cargarLetras();
            echo "\n";
            echo "Ingrese el apellido: ";
            $ap = cargarLetras();
            echo "\n";
            echo "Ingrese el numero de documento: ";
            $nroDni = cargarNumerico();
            echo "\n";
            echo "Ingrese el numero telefono: ";
            $nroTel = cargarNumerico();
            echo "\n";
            $pas = new Pasajero();
            if($pas->buscar($nroDni)){
                echo "----------------------------------------------------\n";
                echo "-------------------- ERROR  ------------------------\n";
                echo "El pasajero: \n".$pas."Ya contiene el dni asignado. \n";
                echo "----------------------------------------------------\n";
            }else{
                $pas->cargar($ap, $nom, $nroDni, $nroTel, $viaje);
                if(!($pas->insertar())){
                    $pas = null;
                }else{
                    echo "----------------------------------------------------\n";
                    echo "El Pasajero fue creado con exito.\n";
                    echo "----------------------------------------------------\n";
                }
            }
        }
    }else{
        echo "----------------------------------------------------\n";
        echo "El Viaje no tiene asientos disponibles.\n";
        echo "----------------------------------------------------\n";
    }
    return $pas;
}

//Funcion para cargar datos solo con letras
/*
@return STRING
*/
function cargarLetras (){
    $letras = trim(fgets(STDIN));
    $sinEspacios = str_replace(' ', '', $letras);
    $fin = true;
    do{
        if (!ctype_alpha($sinEspacios)){
            echo "Ingrese el dato de forma correcta (usando letras): \n";
            $letras = trim(fgets(STDIN));
            $sinEspacios = str_replace(' ', '', $letras);
        }
        else{
            $fin = false;
        }
    }while($fin);
    return $letras;
}

//funcion Para llamar al menu principal y cambiar de opcion
function menuPrincipal (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                          Bienvenido                              \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                           Opciones:                              \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Crear una Empresa. \n";
    echo "2. Crear un Viaje. \n";
    echo "3. Crear un Responsable. \n";
    echo "4. Crear un Pasajero. \n";
    echo "5. Administrar datos Existientes \n";
    echo "6. Salir. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    echo "\n";
    $opcionSelect = trim(fgets(STDIN));
    if ((is_numeric($opcionSelect)) && $opcionSelect < 7 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "----------------------------------------------------\n";
        echo "Ingrese una opcion valida. \n";
        echo "----------------------------------------------------\n";
    }
    }while (!$corta);
    return $opcionSelect;
}

//funcion para llamar al menu de administrar Empresa y seleccionar la opcion
function menuAdministrar (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                           Opciones:                              \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Administar Informacion de una Empresa. \n";
    echo "2. Administar Informacion de un Responsable. \n";
    echo "3. Administar Informacion de un Viaje. \n";
    echo "4. Administar Informacion de un Pasajero. \n";
    echo "5. Volver. \n";
    echo "6. Salir. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    $opcionSelect = trim(fgets(STDIN));
    echo "\n";
    if ((is_numeric($opcionSelect)) && $opcionSelect < 7 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "----------------------------------------------------\n";
        echo "Ingrese una opcion valida. \n";
        echo "----------------------------------------------------\n";
    }
    }while (!$corta);
    return $opcionSelect;
}

//funcion para llamar al menu opciones de pasajero y seleccionar la opcion
function seleccionarOpcionPasajero (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                       Opciones Del Pasajero:                        \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Modificar datos de un Pasajero. \n";
    echo "2. Mostrar datos de un pasajero. \n";
    echo "3. Mostrar datos de todos los pasajeros. \n";
    echo "4. Borrar el Pasajero. \n";
    echo "5. Volver. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    $opcionSelect = trim(fgets(STDIN));
    echo "\n";
    if ((is_numeric($opcionSelect)) && $opcionSelect < 6 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "----------------------------------------------------\n";
        echo "Ingrese una opcion valida. \n";
        echo "----------------------------------------------------\n";
    }
    }while (!$corta);
    return $opcionSelect;
}

//funcion para llamar al menu opciones de Empresa y seleccionar la opcion
function seleccionarOpcionEmpresa (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                       Opciones De Empresa:                       \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Modificar datos de una Empresa. \n";
    echo "2. Mostrar datos de una Empresa. \n";
    echo "3. Mostrar datos de todas las empresas. \n";
    echo "4. Borrar una empresa. \n";
    echo "5. Volver. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    $opcionSelect = trim(fgets(STDIN));
    echo "\n";
    if ((is_numeric($opcionSelect)) && $opcionSelect < 6 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "----------------------------------------------------\n";
        echo "Ingrese una opcion valida. \n";
        echo "----------------------------------------------------\n";
    }
    }while (!$corta);
    return $opcionSelect;
}

//funcion para llamar al menu opciones de viaje y seleccionar la opcion
function seleccionarOpcionViaje (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                       Opciones Del Viaje:                        \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Modificar datos de un viaje. \n";
    echo "2. Agregar pasajero a un viaje. \n";
    echo "3. Mostrar informacion de un viaje. \n";
    echo "4. Mostrar informacion de todos los viajes. \n";
    echo "5. Borrar viaje. \n";
    echo "6. Volver. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    $opcionSelect = trim(fgets(STDIN));
    echo "\n";
    if ((is_numeric($opcionSelect)) && $opcionSelect < 8 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "----------------------------------------------------\n";
        echo "Ingrese una opcion valida. \n";
        echo "----------------------------------------------------\n";
    }
    }while (!$corta);
    return $opcionSelect;
}

//funcion para llamar al menu opciones de Responsable y seleccionar la opcion
function seleccionarOpcionResponsable (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                     Opciones Del Responsable:                        \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Modificar datos de un Responsable. \n";
    echo "2. Mostrar datos de un Responsable. \n";
    echo "3. Mostrar datos de todos los responsables. \n";
    echo "4. Borrar un Responsable.\n";
    echo "5. Volver. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    $opcionSelect = trim(fgets(STDIN));
    echo "\n";
    if ((is_numeric($opcionSelect)) && $opcionSelect < 6 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "----------------------------------------------------\n";
        echo "Ingrese una opcion valida. \n";
        echo "----------------------------------------------------\n";
    }
    }while (!$corta);
    return $opcionSelect;
}

do {
    $sigue = false;

    //llamo a funcion del primer menu
    $opcion = menuPrincipal();
    
    switch ($opcion){
        case 1://Crear Empresa
            crearEmpresa();
            break;
        case 2://Crear un Viaje
            crearViaje();
            break;
        case 3://Crear Responsable
            crearResponsable();
            break;
        case 4://Crear Pasajero
            crearPasajero();
            break;
        case 5://Administrar datos existentes
            $sigue = true;
            break;
        case 6://salir
            echo "\n";
            echo "///////////////////////////////////////////////////////////////// \n";
            echo "             GRACIAS por ultilizar nuestros servicios.             \n";
            echo "///////////////////////////////////////////////////////////////// \n";
            echo "\n";
            break;
    }

    if($sigue){
        do {
            //llamo a funcion del segundo menu
            $opcion = menuAdministrar ();   

            //creo un switch que dependiendo la opcion elegida, ejecuta los metodos necesarios
            switch ($opcion) {
                case 1:
                        do{
                            $opEmpresa = seleccionarOpcionEmpresa();
                            switch ($opEmpresa) {
                                case 1:
                                    modificarEmpresa();
                                    break;
                                case 2:
                                    echo "Desea ver las Empresas Existentes? Si/No \n";
                                    $respuesta = cargarSiNo();
                                    if($respuesta == "si"){
                                        verExistentes("e");
                                    }
                                    echo "Seleccione el id de la empresa deseada. \n";
                                    $empresa = idExistente("e");
                                    if($empresa != null){
                                        echo "----------------------------------------------------\n";
                                        echo $empresa;
                                        echo "----------------------------------------------------\n";
                                    }else{
                                        echo "----------------------------------------------------\n";
                                        echo "Usted no selecciono un id valido.\n";
                                        echo "----------------------------------------------------\n";
                                    }
                                    break;
                                case 3:
                                    $empresas = Empresa::listar();
                                    if($empresas != null){
                                        for ($i=0; $i < count($empresas) ; $i++) { 
                                            echo "----------------------------------------------------\n";
                                            echo "Empresa ".($i+1).":\n";
                                            echo $empresas[$i];
                                            echo "----------------------------------------------------\n";
                                        }
                                    }else{
                                        echo "----------------------------------------------------\n";
                                        echo "No se encontraron Empresas. \n";
                                        echo "----------------------------------------------------\n";
                                    }
                                    break;
                                case 4:
                                    echo "----------------------------------------------------\n";
                                    echo "!!!!!!!!!!!!!!!!!     ATENCION     !!!!!!!!!!!!!!!!!\n";
                                    echo "ESTA A PUNTO DE BORRAR LA EMPRESA Y TODOS LOS DATOS \nRELACIONADOS A ELLA, VIAJES, ENCARGADOS Y PASAJEROS\n";
                                    echo "----------------------------------------------------\n";
                                    echo "Desea Continuar? Si/No \n";
                                    $respuesta = cargarSiNo();
                                    if($respuesta == "si"){
                                        echo "Desea ver las Empresas Existentes? Si/No \n";
                                        $respuesta = cargarSiNo();
                                        if($respuesta == "si"){
                                            verExistentes("e");
                                        }
                                        echo "Seleccione el id de la empresa deseada. \n";
                                        $empresa = idExistente("e");
                                        if($empresa != null){
                                            $viaje= new Viaje();
                                            $viaje->borrarDeEmpresa($empresa->getIdempresa());
                                            if($empresa->borrarDatos()){
                                                echo "----------------------------------------------------\n";
                                                echo "Se ha borrado la empresa con exito. \n";
                                                echo "----------------------------------------------------\n";
                                            }else{
                                                echo "----------------------------------------------------\n";
                                                echo "Ah ocurrido un error. \n";
                                                echo "----------------------------------------------------\n";
                                            }
                                        }else{
                                            echo "----------------------------------------------------\n";
                                            echo "Usted no selecciono un id valido.\n";
                                            echo "----------------------------------------------------\n";
                                        }
                                    }
                                    break;
                            }
                        }while(!($opEmpresa == 5));
                    break;
                case 2:
                    do{
                    $opResp = seleccionarOpcionResponsable();
                    switch ($opResp) {
                        case 1:
                            modificarResponsable();
                            break;
                        case 2:
                            echo "Desea ver los responsables Existentes? Si/No \n";
                            $respuesta = cargarSiNo();
                            if($respuesta == "si"){
                                verExistentes("r");
                            }
                            echo "Seleccione el id del responsable deseado. \n";
                            $responsable = idExistente("r");
                            if($responsable != null){
                                echo "----------------------------------------------------\n";
                                echo $responsable;
                                echo "----------------------------------------------------\n";
                            }else{
                                echo "----------------------------------------------------\n";
                                echo "Usted no selecciono un id valido.\n";
                                echo "----------------------------------------------------\n";
                            }
                            break;
                        case 3:
                            $responsables = ResponsableV::listar();
                            if($responsables != null){
                                for ($i=0; $i < count($responsables) ; $i++) { 
                                    echo "----------------------------------------------------\n";
                                    echo "Responsable ".($i+1).":\n";
                                    echo $responsables[$i];
                                    echo "----------------------------------------------------\n";
                                }
                            }else{
                                echo "----------------------------------------------------\n";
                                echo "No se encontraron Responsables. \n";
                                echo "----------------------------------------------------\n";
                            }
                            break;
                        case 4: //COMPROBARRRRRRRRRRRRRRRRRR
                            echo "Desea ver los responsables Existentes? Si/No \n";
                            $respuesta = cargarSiNo();
                            if($respuesta == "si"){
                                verExistentes("r");
                            }
                            echo "Seleccione el id del responsable deseado. \n";
                            $responsable = idExistente("r");
                            if($responsable != null){
                                $viajes = Viaje::listar("rnumeroempleado = ".$responsable->getRnumeroempleado());
                                echo "----------------------------------------------------\n";
                                echo "!!!!!!!!!!!!!!!!!     ATENCION     !!!!!!!!!!!!!!!!!\n";
                                echo "ESTA A PUNTO DE BORRAR UN RESPONSABLE DE VIAJE, DEBERA \nASIGNAR UN RESPONSABLE NUEVO A El VIAJE AFECTADO \nEN CASO DE QUE LO HAYA.\n";
                                if($viajes != null && count($viajes) == 1){
                                    echo "Id viaje afectado: ".$viajes[0]->getIdviaje()."\n";
                                }
                                echo "----------------------------------------------------\n";
                                if($viajes != null && count($viajes) > 1){
                                    echo "----------------------------------------------------\n";
                                    echo "NO PUEDE BORRARSE EL RESPONSABLE DEBIDO A QUE AFECTARIA\nA MAS DE 1 VIAJE\n";
                                    echo "Viajes Afectados: \n";
                                    for ($i=0; $i < count($viajes) ; $i++) { 
                                        echo "Viaje id: ".$viajes[$i]->getIdviaje()."\n";
                                    }
                                    echo "----------------------------------------------------\n";
                                }else{
                                    echo "Desea Continuar? Si/No \n";
                                $respuesta = cargarSiNo();
                                if($respuesta == "si"){
                                    if($responsable->borrarDatos()){
                                        echo "----------------------------------------------------\n";
                                        echo "Se ha borrado el responsable con exito. \n";
                                        echo "----------------------------------------------------\n";
                                    }else{
                                        echo "----------------------------------------------------\n";
                                        echo "Ah ocurrido un error. \n";
                                        echo "----------------------------------------------------\n";
                                    }
                                }
                            }
                                }
                            break;
                    }
                }while(!($opResp == 5));
                    break;
                case 3:
                    do{
                    $opViaje = seleccionarOpcionViaje();
                    switch ($opViaje) {
                        case 1:
                            modificarViaje();
                            break;
                        case 2:
                            echo "Debe seleccionar el viaje al que agregar el pasajero. \n";
                            echo "Desea ver los Viajes Existentes? Si/No \n";
                            $respuesta = cargarSiNo();
                            if($respuesta == "si"){
                                verExistentes("v");
                            }
                            echo "Seleccione el id del viaje deseado. \n";
                            $viaje = idExistente("v");
                            if($viaje != null){
                                crearPasajero($viaje);
                            }else{
                                echo "----------------------------------------------------\n";
                                echo "Usted no selecciono un id valido.\n";
                                echo "----------------------------------------------------\n";
                            }
                            break;
                        case 3:
                            echo "Desea ver los Viajes Existentes? Si/No \n";
                            $respuesta = cargarSiNo();
                            if($respuesta == "si"){
                                verExistentes("v");
                            }
                            echo "Seleccione el id del viaje deseado. \n";
                            $viaje = idExistente("v");
                            if($viaje != null){
                                echo "----------------------------------------------------\n";
                                echo $viaje;
                                echo "----------------------------------------------------\n";
                            }else{
                                echo "----------------------------------------------------\n";
                                echo "Usted no selecciono un id valido.\n";
                                echo "----------------------------------------------------\n";
                            }
                            break;
                        case 4:
                            $viajes = Viaje::listar();
                            if($viajes != null){
                                for ($i=0; $i < count($viajes) ; $i++) { 
                                    echo "----------------------------------------------------\n";
                                    echo "Viaje ".($i+1).":\n";
                                    echo $viajes[$i];
                                    echo "----------------------------------------------------\n";
                                }
                            }else{
                                echo "No se encontraron Viajes. \n";
                            }
                            break;
                        case 5: //COMPROBARRRRRRRRRRRRRRRRRR
                            echo "----------------------------------------------------\n";
                            echo "!!!!!!!!!!!!!!!!!     ATENCION     !!!!!!!!!!!!!!!!!\n";
                            echo "ESTA A PUNTO DE BORRAR UN VIAJE, Y TODA SU INFORMACION \nBORRARA TODOS LOS PASAJEROS\n";
                            echo "----------------------------------------------------\n";
                            echo "Desea Continuar? Si/No \n";
                            $respuesta = cargarSiNo();
                            if($respuesta == "si"){
                                echo "Desea ver los viajes Existentes? Si/No \n";
                                $respuesta = cargarSiNo();
                                if($respuesta == "si"){
                                    verExistentes("v");
                                }
                                echo "Seleccione el id del viaje deseado. \n";
                                $viaje = idExistente("v");
                                if($viaje != null){
                                    $viaje->getPasajeros()[0]->borrarPasajerosDe($viaje->getIdviaje());
                                    //$enc->borrarDatos();
                                    if($viaje->borrarDatos()){
                                        echo "----------------------------------------------------\n";
                                        echo "Se ha borrado el viaje con exito. \n";
                                        echo "----------------------------------------------------\n";
                                    }else{
                                        echo "----------------------------------------------------\n";
                                        echo "Ah ocurrido un error".$viaje->getError()."\n";
                                        echo "----------------------------------------------------\n";
                                    }
                                      
                                }else{
                                    echo "----------------------------------------------------\n";
                                    echo "Usted no selecciono un id valido.\n";
                                    echo "----------------------------------------------------\n";
                                }
                            }
                            break;
                    }
                }while(!($opViaje == 6));
                    break;
                case 4:
                    do{
                    $opPas = seleccionarOpcionPasajero();
                    switch ($opPas) {
                        case 1:
                            modificarPasajero();
                            break;
                        case 2:
                            echo "Desea ver los Pasajeros Existentes? Si/No \n";
                            $respuesta = cargarSiNo();
                            if($respuesta == "si"){
                                verExistentes("p");
                            }
                            echo "Seleccione el id del viaje deseado. \n";
                            $pasajero = idExistente("p");
                            if($pasajero != null){
                                echo "----------------------------------------------------\n";
                                echo $pasajero;
                                echo "----------------------------------------------------\n";
                            }else{
                                echo "----------------------------------------------------\n";
                                echo "Usted no selecciono un id valido.\n";
                                echo "----------------------------------------------------\n";
                            }
                            break;
                        case 3:
                            $pasajeros = Pasajero::listar();
                            if($pasajeros != null){
                                for ($i=0; $i < count($pasajeros) ; $i++){ 
                                    echo "----------------------------------------------------\n";
                                    echo "Pasajero ".($i+1).":\n";
                                    echo $pasajeros[$i];
                                    echo "----------------------------------------------------\n";
                                }
                            }else{
                                echo "----------------------------------------------------\n";
                                echo "No se encontraron Pasajeros. \n";
                                echo "----------------------------------------------------\n";
                            }
                            break;
                        case 4: //COMPROBARRRRRRRRRRRRRRRRRR
                            echo "----------------------------------------------------\n";
                            echo "!!!!!!!!!!!!!!!!!     ATENCION     !!!!!!!!!!!!!!!!!\n";
                            echo "ESTA A PUNTO DE BORRAR PASAJERO DE LA BASE DE DATOS \n";
                            echo "----------------------------------------------------\n";
                            echo "Desea Continuar? Si/No \n";
                            $respuesta = cargarSiNo();
                            if($respuesta == "si"){
                                echo "Desea ver los pasajeros Existentes? Si/No \n";
                                $respuesta = cargarSiNo();
                                if($respuesta == "si"){
                                    verExistentes("p");
                                }
                                echo "Seleccione el dni del pasajero deseado. \n";
                                $pasajero = idExistente("p");
                                if($pasajero != null){
                                    if($pasajero->borrarDatos()){
                                        echo "----------------------------------------------------\n";
                                        echo "Se ha borrado el pasajero con exito. \n";
                                        echo "----------------------------------------------------\n";
                                    }else{
                                        echo "----------------------------------------------------\n";
                                        echo "Ah ocurrido un error. ".$pasajero->getError()."\n";
                                        echo "----------------------------------------------------\n";
                                    }
                                }else{
                                    echo "----------------------------------------------------\n";
                                    echo "Usted no selecciono un id valido.\n";
                                    echo "----------------------------------------------------\n";
                                }  
                            }
                            break;
                    }
                }while(!($opPas == 5));
                    break;
                case 6:
                    echo "\n";
                    echo "///////////////////////////////////////////////////////////////// \n";
                    echo "             GRACIAS por ultilizar nuestros servicios.            \n";
                    echo "///////////////////////////////////////////////////////////////// \n";
                    echo "\n";
                    break;
            }
        } while (!($opcion == 6 ) && !($opcion == 5)); //en el caso del 5, solo cortaria este do, y regresaria al primer menu
    }
} while (!($opcion == 6));