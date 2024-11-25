<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre - Legajo - Carrera - mail - Usuario Github */
/* Parra Joaquin -  FAI 5556 - TUDW - joaquinparra.nqn@gmail.com - joaquinparra2004 */
/* Britos Gabriel - FAI 5629 - TUDW - gabriel.britos.epet20@gmail.com - gBritos11 */

/**************************************/
/****** DECLARACIÓN DE ARRAYS *********/
/**************************************/

/*
 * Funcion que obtiene un arreglo indexado de una colección de palabras
 * @RETURN ARRAY
*/
function cargarColeccionPalabras(){
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "TENIS", "POLLO", "VERDE", "ARBOL", "JAMON",
        "TECLA", "HORAS", "PATOS", "VODKA", "MOUSE",
        "SOLAR", "LARGO", "CIELO", "NUEVO", "VIAJE",
        "SALTA", "FRUTA", "CIEGA", "PUNTO", "CAMPO"
    ];

    return $coleccionPalabras;
}

/*
 * Funcion que obtiene una arreglo multidimensional de las partidas ya jugadas
 * @RETURN ARRAY
 */
function cargarPartidas()
{
    $coleccionPartidas = [];
    // Asignar las palabras y los datos dentro del arreglo coleccionPartidas
    $coleccionPartidas[0] = ["palabraWordix" => "GATOS", "jugador" => "joaquin", "puntaje" => 0];
    $coleccionPartidas[1] = ["palabraWordix" => "MOUSE", "jugador" => "ana", "puntaje" => 5];
    $coleccionPartidas[2] = ["palabraWordix" => "TECLA", "jugador" => "pedro", "puntaje" => 10];
    $coleccionPartidas[3] = ["palabraWordix" => "SOLAR", "jugador" => "luisa", "puntaje" => 8];
    $coleccionPartidas[4] = ["palabraWordix" => "LARGO", "jugador" => "carla", "puntaje" => 3];
    $coleccionPartidas[5] = ["palabraWordix" => "CIELO", "jugador" => "juan", "puntaje" => 12];
    $coleccionPartidas[6] = ["palabraWordix" => "NUEVO", "jugador" => "lucas", "puntaje" => 7];
    $coleccionPartidas[7] = ["palabraWordix" => "ARBOL", "jugador" => "maria", "puntaje" => 15];
    $coleccionPartidas[8] = ["palabraWordix" => "VIAJE", "jugador" => "pedro", "puntaje" => 6];
    $coleccionPartidas[9] = ["palabraWordix" => "SALTA", "jugador" => "marta", "puntaje" => 9];
    $coleccionPartidas[10] = ["palabraWordix" => "FRUTA", "jugador" => "camila", "puntaje" => 4];
    $coleccionPartidas[11] = ["palabraWordix" => "CIEGA", "jugador" => "roberto", "puntaje" => 11];
    $coleccionPartidas[12] = ["palabraWordix" => "PUNTO", "jugador" => "pedro", "puntaje" => 2];
    $coleccionPartidas[13] = ["palabraWordix" => "VODKA", "jugador" => "diana", "puntaje" => 1];
    $coleccionPartidas[14] = ["palabraWordix" => "ARBOL", "jugador" => "luis", "puntaje" => 13];
    $coleccionPartidas[15] = ["palabraWordix" => "CAMPO", "jugador" => "joaquin", "puntaje" => 14];
    // Retorna el arreglo con todas las partidas
    return $coleccionPartidas;
}


/*
 * Funcion que muestra menu de opciones  que el usuario puede seleccionar
 * @RETURN INT
 */
function seleccionarOpcion()
{// int opcion
   echo "\n";
   echo "\n***************************************************\n";
   echo "Bienvenido jugador, seleccione una opción del 1 al 8: \n";
   echo "1: Jugar con palabra elegida. \n";
   echo "2: Jugar con palabra aleatoria. \n";
   echo "3: Mostrar una partida. \n";
   echo "4: Mostrar la primer partida ganada de un jugador. \n";
   echo "5: Mostrar el resumen de un jugador. \n";
   echo "6: Mostrar listado de partidas ordenadas por jugador y palabra. \n";
   echo "7: Agregar una palabra a la colección de Wordix. \n";
   echo "8: Salir de wordix. \n";
   echo "\n***************************************************\n";
   $opcion = solicitarNumeroEntre(1, 8); // solicitarNumeroEntre() nos cumple que sea un numero entre esos dos desde wordix.php
   return ($opcion);
}

/*
 * Funcion que solicita al usuario ingresar un numero de partida
 * @PARAM ARRAY $coleccionPartidas
 * @RETURN INT 
 */

function solicitarNumeroPartida($coleccionPartidas){
//INT $cantPartidas, $numeroPartida

    $cantPartidas = count($coleccionPartidas); // pasa la coleccion a cantidad
    echo"Ingrese el numero de partida que desea mostrar: ";
    $numeroPartida = solicitarNumeroEntre(1,$cantPartidas); // verifica que sea desde el 1 hasta la cantidad de partidas
    $numeroPartida = $numeroPartida -1 ; // convierte el numero de partida en el indice para el array( siempre es -1)

    return $numeroPartida;

}

/*
 * funcion que muestra los datos de una partida jugada
 * @PARAM INT $numeroPartida = solicitarNumeroPartida()
 * @PARAM ARRAY $coleccionPartidas
 * @RETURN STRING $mensaje
 */
function mostrarPartida($numeroPartida, $coleccionPartidas){

    $auxNumeroPartida = $numeroPartida + 1; //pasa de tener el indice del array, a agregarle 1 para mostrar que numero de partida es
    $palabra = $coleccionPartidas[$numeroPartida]["palabraWordix"];
    $jugador = $coleccionPartidas[$numeroPartida]["jugador"];
    $puntaje = $coleccionPartidas[$numeroPartida]["puntaje"];
    $intentos = $coleccionPartidas[$numeroPartida]["intentos"];

    if ($puntaje = 0) {
        $msjIntento = "No adivinó la palabra\n";
    } else {
        $msjIntento = "Adivinó la palabra en " . $intentos . " intentos\n";
    }

    $mensaje =  "**************************************************************\n   
    Partida WORDIX $auxNumeroPartida: palabra $palabra \n          
    Jugador: $jugador \n               
    Puntaje: $puntaje puntos \n        
    Intento: $msjIntento
    \n**************************************************************";

    return $mensaje;
}

/*
 * funcion que permite agregar una palabra (elemento) a la coleccion de palabras
 * @PARAM STRING $palabra = leerPalabra5Letras()
 * @PARAM ARRAY $coleccionPalabras 
 * @RETURN ARRAY
 */

function agregarPalabra($palabra,$coleccionPalabras){

    //in_array() recorre el array y verifica si la palabra ya esta en el arreglo
    // si ya esta la palabra en el array, entonces in_array() devolvera true

    if (in_array($palabra, $coleccionPalabras)) {
        // Si la palabra ya existe, agregar un mensaje de error a la colección
        $coleccionPalabras[] = "La palabra ya se encuentra almacenada.";
    } else {
        // Si no existe, agregarla a la colección
        $coleccionPalabras[] = $palabra;
    }
    
    // Retornar la colección (con o sin el mensaje)
    return $coleccionPalabras;
}







}

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/









































/**
 * Funcion que pide al usuario ingresar palabra de 5 letras
 * @return string
 */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
