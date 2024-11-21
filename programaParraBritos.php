<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre - Legajo - Carrera - mail - Usuario Github */
/* Parra Joaquin -  FAI 5556 - TUDW - joaquinparra.nqn@gmail.com - joaquinparra2004 */
/* Britos Gabriel - FAI 5629 - TUDW - gabriel.britos.epet20@gmail.com - gBritos11 */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Funcion que obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "TENIS", "POLLO", "VERDE", "ARBOL", "JAMON",
        "TECLA", "HORAS", "PATOS", "VODKA", "MOUSE",
    ];
    return ($coleccionPalabras);
}


/**
 * Funcion que obtiene una coleccion de partidas ya jugadas
 * @return array
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
    $coleccionPartidas[12] = ["palabraWordix" => "PUNTO", "jugador" => "jorge", "puntaje" => 2];
    $coleccionPartidas[13] = ["palabraWordix" => "VODKA", "jugador" => "diana", "puntaje" => 1];
    $coleccionPartidas[14] = ["palabraWordix" => "ARBOL", "jugador" => "luis", "puntaje" => 13];
    $coleccionPartidas[15] = ["palabraWordix" => "CAMPO", "jugador" => "marcos", "puntaje" => 14];

    // Retorna el arreglo con todas las partidas
    return $coleccionPartidas;
}


/**
 * Funcion que muestra menu de opciones  que el usuario puede seleccionar
 * @return array
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
    $opcion = solicitarNumeroEntre(1, 8); //llamamos a funcion de wordix.php
    return ($opcion);
 }


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

$partida = jugarWordix("MELON", strtolower("MaJo"));
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
