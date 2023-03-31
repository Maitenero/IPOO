<?php
include 'Viaje.php';//incluyo el archivo de la clase viaje

//Creo el array de pasajeros ------PREGUNTAR-------- es asi? jjsdj
$pasajeros = array (
    $pasajeros[1]  = ["Nombre"=>"Mario","Apellido"=>"Valenzuela","DNI"=>"33057431"],
    $pasajeros[2]  = ["Nombre"=>"Juan","Apellido"=>"Micha","DNI"=>"34849769"],
    $pasajeros[3]  = ["Nombre"=>"Martin","Apellido"=>"Miralobos","DNI"=>"38106564"], 
    $pasajeros[4]  = ["Nombre"=>"Roberto","Apellido"=>"Palacios","DNI"=>"44653216"],
    $pasajeros[5]  = ["Nombre"=>"Martin","Apellido"=>"Coronado","DNI"=>"30660528"],
    $pasajeros[6]  = ["Nombre"=>"Rocio","Apellido"=>"Palacios","DNI"=>"29700003"],
    $pasajeros[7]  = ["Nombre"=>"Pedro","Apellido"=>"Berni","DNI"=>"39883267"],
    $pasajeros[8]  = ["Nombre"=>"Julieta","Apellido"=>"Palacios","DNI"=>"20981558"],
    $pasajeros[9]  = ["Nombre"=>"Sofia","Apellido"=>"Cuevas","DNI"=>"37750983"],
    $pasajeros[10]  = ["Nombre"=>"Mario","Apellido"=>"Pergolini","DNI"=>"32201076"],
    $pasajeros[11]  = ["Nombre"=>"Norbeto","Apellido"=>"De La Sal","DNI"=>"28644442"],
    $pasajeros[12]  = ["Nombre"=>"Homero J.","Apellido"=>"Simpson","DNI"=>"27451663"], 
    $pasajeros[13]  = ["Nombre"=>"Ned","Apellido"=>"Flanders","DNI"=>"38698349"],
    $pasajeros[14]  = ["Nombre"=>"Antonella","Apellido"=>"Rocuzzo","DNI"=>"29034281"],
    $pasajeros[15]  = ["Nombre"=>"Lionel","Apellido"=>"Messi","DNI"=>"24509044"],
    $pasajeros[16]  = ["Nombre"=>"Roberto","Apellido"=>"Carlos","DNI"=>"33062348"],
    $pasajeros[17]  = ["Nombre"=>"Carlos","Apellido"=>"Duende","DNI"=>"31743891"],
    $pasajeros[18]  = ["Nombre"=>"Sofia","Apellido"=>"Miralobos","DNI"=>"23407994"]
);

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
function cargarLosPasajeros ($tope){
    $tope = $tope - 1;
    $arreglo = array ();
    echo "Desea cargar un pasajero? (si/no): ";
    $select = trim(fgets(STDIN));
    echo "\n";
    while ((strtolower($select)) == "si" && (count($arreglo)) <= $tope){
        echo "Ingrese el nombre del pasajero: ";
        $nom = cargarLetras();
        echo "\n";
        echo "Ingrese el apellido del pasajero: ";
        $ap = cargarLetras();
        echo "\n";
        echo "Ingrese el numero de documento: ";
        $nroDni = cargarNumerico();
        echo "\n";
        array_push($arreglo, ["Nombre"=>$nom,"Apellido"=>$ap,"DNI"=>$nroDni]);
        echo "Desea cargar otro pasajero? (si/no) ";
        $select = trim(fgets(STDIN));
        echo "\n";
        if (count($arreglo) == ($tope + 1)){
            echo "No puedes agregar mas pasajeros debido a que llegaste al maximo de pasajeros posibles. \n";
            echo "\n";
        }
    }
    return $arreglo;
}

//Creo la funcion para crear un nuevo objeto viaje
/*
@return OBJET  || ?????? COMO SE ESCRIBIRIA? 
*/
function crearViaje (){
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
    $pasjerosViaje = cargarLosPasajeros ($pasajerosMaximos);

    $objeto = new Viaje ($codigo, $destino, $pasajerosMaximos, $pasjerosViaje);

    return $objeto;
    
}          

//Creo una funcion que me diga si el objeto existe o no 
/*
@return INT
*/
function existe ($arregloViajes, $codViaje){
    $i = 0;
    $band = true;
    $indice = -1;
    while (( $i < (count($arregloViajes))) && $band ){
        $clave = $arregloViajes[$i]->getCodigoViaje ();
        if (strcmp($clave, $codViaje) === 0){
            echo "\n";
            echo "El viaje fue cargado correctamente. \n";
            echo "\n";
            $band = false;
            $indice = $i;
        }
        elseif (((count($arregloViajes)) == $i) && ($indice == -1)) {
            echo "\n";
            echo "No se encontro el viaje con ese codigo. \n";
            echo "\n";
        }
        $i++;
    }
    return $indice;
}

//Creo Una funcion que depliega el menu para seleccionar la opcion
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

//Creo Una funcion que depliega el menu para seleccionar la opcion
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
    echo "5. Cambiar el Nombre de un pasajero. \n";
    echo "6. Cambiar el apellido de un Pasajero. \n";
    echo "7. Cambiar el DNI de un pasajero. \n";
    echo "8. Modificar todos los datos de un pasajero. \n";
    echo "9. Agregar un pasajero. \n";
    echo "10. Volver. \n";
    echo "11. Salir. \n";
    echo "///////////////////////////////////////////////////////////////// \n";
    echo "Seleccione la opcion deseada: ";
    $opcionSelect = trim(fgets(STDIN));
    echo "\n";
    if ((is_numeric($opcionSelect)) && $opcionSelect < 12 && $opcionSelect > 0){
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

//creo mi array $viajes para almacenar todos los viajes..
$viajes = array ();

//creo el objeto $viaje1
$viaje1 = new Viaje (44302, "Mendoza", 35, $pasajeros);
array_push ($viajes, $viaje1); //lo pusheo a mi array viajes


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
            array_push ($viajes, $nuevoViaje);
            echo "\n";
            break;
        case 2:
            echo "Escriba el codigo del viaje deseado: \n";
            $viajeDes = cargarNumerico ();
            $seguir = existe ($viajes, $viajeDes);
            echo "\n";
            if ($seguir == -1){
                echo "El viaje ".$viajeDes." no pudo ser encontrado, vuelva a intentarlo. \n";
                echo "\n";
            }
            break;
        case 3:
            $opcion = 11;
            break;
    }

    if ($seguir !== -1){//ingreso solo si la funcion | existe() | me retorna el indice donde se encuentra el obejto en el array
        do {

            //llamo a funcion del segundo menu
            $opcion = seleccionarOpcionViaje ();   

            //creo un switch que dependiendo la opcion elegida, ejecuta los metodos necesarios
            switch ($opcion) {
                    case 1: //Ver la informacion del viaje
                    $funciono = $viajes[$seguir]->mostrarDatos();
                    echo $funciono;
                    break;

                case 2: //Cambiar el codigo del viaje
                    echo "Escriba nuevo codigo de viaje: ";
                    $nuevoCodigo = cargarNumerico ();
                    $viajes[$seguir]->cambiarCodigo($nuevoCodigo);
                    echo "El cambio fue realizado con exito. \n";
                    echo "\n";
                    break;
                case 3: //Cambiar el destino del viaje
                        echo "Escriba el nuevo destino: ";
                        $nuevoDestino = cargarLetras();
                        echo "\n";
                        $viajes[$seguir]->cambiarDestino($nuevoDestino);
                        echo "El cambio fue realizado con exito. \n";
                        echo "\n";
                    break;
                case 4: //Cambiar el maximo de pasajeros
                        echo "Escriba el nuevo numero maximo de pasajeros: ";
                        $nuevoMaximo = cargarNumerico();
                        $viajes[$seguir]->cambiarCantPasajeros($nuevoMaximo);
                        echo "El cambio fue realizado con exito. \n";
                        echo "\n";
                    break;
                case 5: //Cambiar el nombre de un pasajero
                        echo "Escriba el DNI del pasajero: ";
                        $dni = cargarNumerico();
                        echo "\n";
                        echo "Escriba el nuevo nombre del pasajero: ";
                        $nombre = cargarLetras();
                        echo "\n";
                        $funciono = $viajes[$seguir]->cambiarNombrePas($dni,$nombre);
                        echo $funciono;
                    break;
                case 6: //Cambiar el apellido de un pasajero
                        echo "Escriba el DNI del pasajero: ";
                        $dni = cargarNumerico();
                        $valido = true;
                        echo "\n";
                        echo "Escriba el nuevo apellido del pasajero: ";
                        $apellido = cargarLetras();
                        echo "\n";
                        $funciono = $viajes[$seguir]->cambiarApellidoPas($dni,$apellido); 
                        echo $funciono; 
                    break;
                case 7: //Cambiar el DNI de un pasajero
                        echo "Escriba el DNI del pasajero: ";
                        $dni = cargarNumerico();
                        echo "\n";
                        echo "Escriba el nuevo DNI del pasajero: ";
                        $newDni = cargarNumerico();
                        echo "\n";
                        $funciono = $viajes[$seguir]->cambiarDniPas($dni,$newDni);
                        echo $funciono;
                    break;
                case 8: //Cambiar todos los datos de un pasajero ||| PREGUNTAR SI ES MEJOR ANIDAR TODOS LOS IF?????
                        echo "Escriba el DNI del pasajero a ser reemplazado: ";
                        $dni = cargarNumerico();
                        echo "\n";
                        echo "Escriba el nuevo nombre del pasajero: ";
                        $nombre = cargarLetras();
                        echo "\n";
                        echo "Escriba el nuevo apellido del pasajero: ";
                        $apellido = cargarLetras();
                        echo "\n";
                        echo "Escriba el nuevo DNI del pasajero: ";
                        $newDni = cargarNumerico();
                        echo "\n";
                        $funciono = $viajes[$seguir]->cambiarPasajero($dni,$nombre,$apellido,$newDni);
                        echo $funciono;
                    break;
                case 9: //Agregar un nuevo pasajero
                        echo "Ingrese el nombre del pasajero a agregar: \n";
                        $nombre = cargarLetras();
                        echo "\n";
                        echo "Ingrese el apellido del pasajero a agregar: \n";
                        $apellido = cargarLetras();
                        echo "\n";
                        echo "Ingrese el dni del pasajero a agregar: \n";
                        $dni = cargarNumerico();
                        echo "\n";
                        $funciono = $viajes[$seguir]->agregarPasajero($nombre,$apellido,$dni);
                        echo $funciono;
                    break;
                case 11: //salir del menu
                    echo "\n";
                    echo "Viaje Feliz le agradace por ultilizar sus servicios. \n";
                    echo "\n";
                    break;
            }
        } while (!($opcion == 11 ) && !($opcion == 10)); //en el caso del 10, solo cortaria este do, y regresaria al primer menu
    }
} while (!($opcion == 11 ));