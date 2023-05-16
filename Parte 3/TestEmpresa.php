<?php
include_once ('Viaje.php');//incluyo los archivo de las clases 
include_once ('Pasajero.php');
include_once ('ResponsableV.php');
include_once ('Empresa.php');
include_once ('PasajeroVip.php');
include_once ('PasajeroEsp.php');

//Creo el array de pasajeros
$pasajeros = array (
    $pasajeros[1]  = new Pasajero ("Mario","Valenzuela",1,1432523),
    $pasajeros[2]  = new Pasajero ("Juan","Micha",5,45674567),
    $pasajeros[3]  = new Pasajero ("Martin","Miralobos",3,243521345), 
    $pasajeros[4]  = new Pasajero ("Roberto","Palacios",4,23452345),
    $pasajeros[6]  = new Pasajero ("Rocio","Palacios",2,342523),
    $pasajeros[7]  = new Pasajero ("Pedro","Berni",6,3245736),
    $pasajeros[8] = new Pasajero ("Julieta","Palacios",8,1435),
    $pasajeros[9]  = new Pasajero ("Sofia","Cuevas",7,65789),
    $pasajeros[10]  = new Pasajero ("Mario","Pergolini",10,24356),
    $pasajeros[11] = new Pasajero ("Norbeto","De La Sal",28,34568),
    $pasajeros[12]  = new Pasajero ("Homero J.","Simpson",27,4356), 
    $pasajeros[13]  = new Pasajero ("Ned","Flanders",38,3456),
    $pasajeros[14]  = new Pasajero ("Antonella","Rocuzzo",29,34657),
    $pasajeros[15]  = new Pasajero ("Lionel","Messi",24,23456),
    $pasajeros[16]  = new Pasajero ("Roberto","Carlos",33,35467),
    $pasajeros[17] = new Pasajero ("Carlos","Duende",31,23456),
    $pasajeros[18]  = new Pasajero ("Sofia","Miralobos",23,245623456)
);

//creo un responsable de viaje para mi viaje pre cargado
$resp1= new ResponsableV (12345,123456,"Julio","Amarillo");

//creo mi array $viajes para almacenar todos los viajes..
$viajes = array ();

//creo el objeto $viaje1
$viaje1 = new Viaje (44302, "Mendoza", 35, $pasajeros, $resp1, 2000, 450000);
array_push ($viajes, $viaje1); //lo pusheo a mi array viajes |||||| Vi en discord que se va a trabajar solo con un viaje, pero ya habia hecho todo el codigo con array y funcionando de esta manera, no me parecio mal dejarlo asi

$empresa = new Empresa ($viajes, $pasajeros);

//echo $empresa->__toString(); //solo para probar funcionamiento. 

//Funcion para cargar datos numericos
/*
@return INT
*/
function cargarNumerico (){
    $numero = trim(fgets(STDIN));
    $fin = true;
    do{
        if (!is_numeric($numero)){
            echo "Ingrese el dato de forma correcta (usando numeros): \n";
            $numero = trim(fgets(STDIN));
        }
        else{
            $fin = false;
        }
    }while($fin);
    return $numero;
}

//Funcion para cargar datos solo con letras
/*
@return STRING
*/
function cargarLetras (){
    $letras = trim(fgets(STDIN));
    $fin = true;
    do{
        if (!ctype_alpha($letras)){
            echo "Ingrese el dato de forma correcta (usando letras): \n";
            $letras = trim(fgets(STDIN));
        }
        else{
            $fin = false;
        }
    }while($fin);
    return $letras;
}

//Creo una funcion que permita cargar pasajeros y retorna un array de pasajeros
/*
@return ARRAY
*/
/*function cargarLosPasajeros ($tope){
    $tope = $tope - 1;
    $arreglo = array ();
    $pasajero = null;
    echo "Desea cargar un pasajero? (si/no): ";
    $select = trim(fgets(STDIN));
    echo "\n";
    while ((strtolower($select)) == "si" && (count($arreglo)) <= $tope){
        $seRepite = false;
        $i = 0;
        echo "Ingrese el nombre del pasajero: ";
        $nom = cargarLetras();
        echo "\n";
        echo "Ingrese el apellido del pasajero: ";
        $ap = cargarLetras();
        echo "\n";
        echo "Ingrese el numero de asiento Deseado: ";
        $nroDni = cargarNumerico();
        echo "\n";
        while ($i < count($arreglo) && !$seRepite) { 
            if (strcmp($nroDni,$arreglo[$i]->getNroDocumento ()) === 0){
                $seRepite = true;
            }
            $i++;
        }
        if(!$seRepite){
            $pasajero = new Pasajero ($nom, $ap, $nroDni, $nroTelefono);
            array_push($arreglo, $pasajero );
        }
        else{
         echo "Ya existe un pasajero con ese DNI. \n";
        }
        echo "Desea cargar otro pasajero? (si/no) ";
        $select = trim(fgets(STDIN));
        echo "\n";
        if (count($arreglo) == ($tope + 1)){
            echo "No puedes agregar mas pasajeros debido a que llegaste al maximo de pasajeros posibles. \n";
            echo "\n";
        }
    }
    return $arreglo;
} */

//funcion para crear un Responsable del viaje
function crearResponsable (){
    echo "Ingrese los datos del Responsable del Viaje. \n";
    echo "Ingrese el numero de Empleado: ";
    $nroEmp = cargarNumerico();
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
       
    $resp = new ResponsableV ($nroEmp, $nroLic, $nom, $ap, );
    return $resp;
}

//Creo la funcion para crear un nuevo objeto viaje
/*
@return OBJET  || ?????? COMO SE ESCRIBIRIA? 
*/
function crearViaje (){
    $total = 0;
    $valor = null;
    $codigo = 0;
    $destino = "";
    $pasajerosMaximos = 0;
    $pasjerosViaje = array ();
    echo "Ingrese el codigo del viaje: \n";
    $codigo = cargarNumerico ();
    echo "\n";
    echo "ingrese el destino del viaje: \n";
    $destino = cargarLetras();
    echo "\n";
    echo "Ingrese la capacidad maxima de pasajeros: \n";
    $pasajerosMaximos = cargarNumerico (); 
    echo "\n";
    //$pasjerosViaje = cargarLosPasajeros ($pasajerosMaximos);
    $respV = crearResponsable ();
    echo "\n";
    echo "Ingrese el valor del pasaje: \n";
    $valor = cargarNumerico();
    echo "\n";

    $objeto = new Viaje ($codigo, $destino, $pasajerosMaximos, $respV,$valor, $total);

    return $objeto;
    
}          


//Creo Una funcion que depliega el menu para seleccionar la opcion principal
/*
@return INT
*/
function seleccionarOpcionPrincipal (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                    Bienvenido A Viaje Feliz                      \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                           Opciones:                              \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Crear un nuevo viaje. \n";
    echo "2. Ver o cambiar los datos de un viaje existente. \n";
    echo "3. Salir. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    echo "\n";
    $opcionSelect = trim(fgets(STDIN));
    if ((is_numeric($opcionSelect)) && $opcionSelect < 4 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "\n";
        echo "Ingrese una opcion valida. \n";
        echo "\n";
    }
    }while (!$corta);
    return $opcionSelect;
}

//Creo Una funcion que depliega el menu para seleccionar la opcion del viaje
/*
@return INT
*/
function seleccionarOpcionViaje (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                       Opciones Del Viaje:                        \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Ver la Informacion del viaje. \n";
    echo "2. Cambiar el codigo del viaje. \n";
    echo "3. Cambiar el destino del viaje. \n";
    echo "4. Cambiar la cantidad maxima de pasajeros. \n";
    echo "5. Cambiar los datos de un pasajero. \n";
    echo "6. Vender un Pasaje. \n";
    echo "7. Volver. \n";
    echo "8. Salir. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    $opcionSelect = trim(fgets(STDIN));
    echo "\n";
    if ((is_numeric($opcionSelect)) && $opcionSelect < 9 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "\n";
        echo "Ingrese una opcion valida. \n";
        echo "\n";
    }
    }while (!$corta);
    return $opcionSelect;
}

//Creo Una funcion que depliega el menu para seleccionar la opcion del pasajero
/*
@return INT
*/
function seleccionarOpcionPasajero (){
    $corta = false;
    do{
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "                       Opciones Del Pasajero:                        \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "\n";
    echo "1. Cambiar el Nombre de un pasajero. \n";
    echo "2. Cambiar el apellido de un Pasajero. \n";
    echo "3. Cambiar Asiento de un pasajero. \n";
    echo "4. Agregar necesidades (solo pasajero especiales). \n";
    echo "5. Modificar todos los datos de un pasajero. \n";
    echo "6. Volver. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    $opcionSelect = trim(fgets(STDIN));
    echo "\n";
    if ((is_numeric($opcionSelect)) && $opcionSelect < 7 && $opcionSelect > 0){
        $corta = true;
    }
    else{
        echo "\n";
        echo "Ingrese una opcion valida. \n";
        echo "\n";
    }
    }while (!$corta);
    return $opcionSelect;
}


//Programa principal se ejecutan las opciones que el usuario seleccione
do {
    //incializo variables a ultilzar en el menu
    // Declaracion de variables INT $dni, $newDni, $nuevoCodigo, $opcion, $opcionPrincipal | String $nombre, $apellido, $nuevoDestino, $funciono  | Boolean $corte, $valido
    $dni = 0;
    $newDni = 0;
    $nuevoCodigo = 0;
    $opcionPrincipal = 0;
    $nombre = " ";
    $apellido = " ";
    $nuevoCodigo = "";
    $funciono = "";
    $corte = false;
    $valido = false;
    $seguir = -1;

    //llamo a funcion del primer menu
    $opcion = seleccionarOpcionPrincipal();

    switch ($opcion){//switch del primer menu
        case 1: 
            $nuevoViaje = crearViaje();
            echo "El viaje se creo con exito. \n";
            $empresa->agregarViaje($nuevoViaje);
            echo "\n";
            break;
        case 2:
            echo "Escriba el codigo del viaje deseado: \n";
            $viajeDes = cargarNumerico ();
            $seguir = $empresa->existe ($viajeDes);
            echo "\n";
            if ($seguir == -1){
                echo "El viaje ".$viajeDes." no pudo ser encontrado, vuelva a intentarlo. \n";
                echo "\n";
            }
            else{
                echo "El viaje ".$viajeDes." se cargo correctamente. \n";
                echo "\n";
            }
            break;
        case 3:
            $opcion = 8;
            echo "\n";
            echo "///////////////////////////////////////////////////////////////// \n";
            echo "       Viaje Feliz le agradece por ultilizar sus servicios.       \n";
            echo "///////////////////////////////////////////////////////////////// \n";
            echo "\n";
            break;
    }

    if ($seguir !== -1){//ingreso solo si la funcion | existe() | me retorna el indice donde se encuentra el obejto en el array
        do {

            //llamo a funcion del segundo menu
            $opcion = seleccionarOpcionViaje ();   

            //creo un switch que dependiendo la opcion elegida, ejecuta los metodos necesarios
            switch ($opcion) {
                    case 1: //Ver la informacion del viaje
                    $funciono = $empresa->getViajes()[$seguir]->__toString();
                    echo $funciono;
                    break;

                case 2: //Cambiar el codigo del viaje
                    echo "Escriba nuevo codigo de viaje: ";
                    $nuevoCodigo = cargarNumerico ();
                    $empresa->getViajes()[$seguir]->cambiarCodigo($nuevoCodigo);
                    echo "El cambio fue realizado con exito. \n";
                    echo "\n";
                    break;
                case 3: //Cambiar el destino del viaje
                        echo "Escriba el nuevo destino: ";
                        $nuevoDestino = cargarLetras();
                        echo "\n";
                        $empresa->getViajes()[$seguir]->cambiarDestino($nuevoDestino);
                        echo "El cambio fue realizado con exito. \n";
                        echo "\n";
                    break;
                case 4: //Cambiar el maximo de pasajeros
                        echo "Escriba el nuevo numero maximo de pasajeros: ";
                        $nuevoMaximo = cargarNumerico();
                        $empresa->getViajes()[$seguir]->cambiarCantPasajeros($nuevoMaximo);
                        echo "El cambio fue realizado con exito. \n";
                        echo "\n";
                    break;
                case 5: //Cambiar datos de un pasajero 
                        $opcionPasajero = seleccionarOpcionPasajero ();
                        if($opcionPasajero > 0 && $opcionPasajero < 6){
                            echo "Escriba el nro de asiento del pasajero a modificar: ";
                            $asiento = cargarNumerico();
                        }
                        switch ($opcionPasajero) {
                            case 1://cambiar el nombre de un pasajero
                                    echo "\n";
                                    echo "Escriba el nuevo nombre del pasajero: ";
                                    $nombre = cargarLetras();
                                    echo "\n";
                                    $funciono = $empresa->getViajes()[$seguir]->cambiarNombrePas($dni,$nombre);
                                    echo $funciono;
                                
                                break;
                            case 2: //Cambiar el apellido de un pasajero
                                    echo "\n";
                                    echo "Escriba el nuevo apellido del pasajero: ";
                                    $apellido = cargarLetras();
                                    echo "\n";
                                    $funciono = $empresa->getViajes()[$seguir]->cambiarAsiento($asiento,$apellido); 
                                    echo $funciono; 
                                break;
                                case 2: //Cambiar el asiento de un pasajero
                                    echo "\n";
                                    echo "Escriba el nuevo asiento del pasajero: ";
                                    $nuevoAsiento = cargarNumerico();
                                    echo "\n";
                                    $funciono = $empresa->getViajes()[$seguir]->cambiarAsiento($asiento,$nuevoAsiento); 
                                    echo $funciono; 
                                break;
                            case 4: //Agregar necesidades
                                    echo "\n";
                                    echo "Escriba la necesidad especial del pasajero: ";
                                    $newNecesidad = cargarLetras();
                                    echo "\n";
                                    $funciono = $empresa->getViajes()[$seguir]->cambiarTelefono($asiento,$newNecesidad);
                                    echo $funciono;
                                break;
                            case 5: //Cambiar todos los datos de un pasajero 
                                    echo "\n";
                                    echo "Escriba el nuevo nombre del pasajero: ";
                                    $nombre = cargarLetras();
                                    echo "\n";
                                    echo "Escriba el nuevo apellido del pasajero: ";
                                    $apellido = cargarLetras();
                                    echo "\n";
                                    echo "Escriba el nuevo asiento del pasajero: ";
                                    $nuevoAsiento = cargarNumerico();
                                    echo "\n";
                                    $funciono = $empresa->getViajes()[$seguir]->cambiarPasajero($asiento,$nombre,$apellido,$nuevoAsiento);
                                    echo $funciono;
                                break;
                        }
                    break;               
                case 6: //Vender un pasaje
                        echo "Ingrese el nombre del pasajero: \n";
                        $nombre = cargarLetras();
                        echo "\n";
                        echo "Ingrese el apellido del pasajero : \n";
                        $apellido = cargarLetras();
                        echo "\n";
                        echo "Ingrese el asiento deseado: \n";
                        $asiento = cargarNumerico();
                        echo "\n";
                        echo "Seleccione el tipo de pasajero (estandar - vip - especial) : \n";
                        $pasajeroEs = cargarLetras();
                        if ($pasajeroEs == "vip"){
                            echo "Ingrese el numero de Viajero Frecuente: \n";
                            $viajFrecuente = cargarNumerico();
                            echo "\n";
                            echo "Ingrese las millas actuales del passajero: \n";
                            $millasAct = cargarNumerico();
                            echo "\n"; 
                            $pasajeroAVender = new PasajeroVip ($nombre, $apellido, $asiento, $viajFrecuente, $millasAct);
                        }
                        elseif ($pasajeroEs == "especial"){
                            $necesidades = [];
                            do {
                                echo "Ingrese la necesidad del pasasajero: \n";
                                $necesidad = cargarLetras();
                                echo "\n";
                                array_push ($necesidades, $necesidad);
                                echo "Desea ingresar otra necesidad? si/no \n";
                                $opcion = cargarNumerico();

                            } while ($opcion == "si");
                            $pasajeroAVender = new PasajeroEsp ($nombre, $apellido, $asiento, $necesidades);
                        }
                        elseif ($pasajeroEs == "estandar") {
                            $pasajeroAVender = new Pasajero ($nombre, $apellido, $asiento);
                        }
                        echo "\n";
                        $empresa->agregarPasajero($pasajeroAVender);
                        $porcent = $empresa->darPorcentajeIncremento($pasajeroAVender);
                        $rta = $empresa->getViajes()[$seguir]->venderPasaje($pasajeroAVender, $porcent);
                        echo "El precio del pasaje es de: ".$rta." \n";
                    break;
                case 8: //salir del menu
                    echo "\n";
                    echo "///////////////////////////////////////////////////////////////// \n";
                    echo "       Viaje Feliz le agradece por ultilizar sus servicios.       \n";
                    echo "///////////////////////////////////////////////////////////////// \n";
                    echo "\n";
                    break;
            }
        } while (!($opcion == 8 ) && !($opcion == 7)); //en el caso del 7, solo cortaria este do, y regresaria al primer menu
    }
} while (!($opcion == 8 ));
