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

/**************************************/
/****** DECLARACIÓN DE ARRAYS *********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
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

/**
 * Obtiene una colección de jugadores
 * @return array
*/
function cargarColeccionJugadores(){
    $coleccionJugadores = [
        "Joaquin", "Ana", "Pedro", "Luisa",
        "Carla", "Juan", "Lucas", "Maria",
        "Pedro", "Marta", "Camila", "Roberto",
        "Jorge", "Diana", "Luis", "Marcos"
    ];

    return $coleccionJugadores;
}

/**
 * Obtiene una coleccion de partidas ya jugadas
 * @param int $cantPartidas = cantidad de partidas que quiero generar
 * @param array $coleccionPalabras = array de palabras Wordix
 * @param array $coleccionJugadores = arra de jugadores registrados
 * @return array
*/

function cargarPartidas( $cantPartidas, $coleccionPalabras, $coleccionJugadores ){
    /*
        int:
            $cont = contador que puede incrementar su valor
            $puntaje = puntaje del 0 al 24 según el rendimiento del jugador
        
        string:
            $palabraWordix = palabra de la colección de palabras
            $jugador = jugador de la colección de jugadores
    */

    $coleccionPartidas = [];

    for( $cont = 1; $cont <=$cantPartidas; $cont++ ){

        $palabraWordix = $coleccionPalabras[ array_rand( $coleccionPalabras ) ];
        $jugador = $coleccionJugadores[ array_rand( $coleccionJugadores ) ];
        $puntaje = rand( 0, 24 );

        $coleccionPartidas[] = [
            "palabraWordix" => $palabraWordix,
            "jugador" => $jugador,
            "puntaje" => $puntaje
        ];
    };

    // Retorna el arreglo con todas las partidas ya cargadas
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
