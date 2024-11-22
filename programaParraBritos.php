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
 * Obtiene las opciones disponibles
 * @return array
*/
function opcionesDisponibles(){
    $opciones = [
        "Jugar Wordix con una palabra elegida",
        "Jugar Wordix con una palabra aleatoria",
        "Mostrar una partida",
        "Mostrar la primera partida ganadora",
        "Mostar resumen del jugador",
        "Mostrar listado de partidas ordenadas por jugador y por palabra",
        "Agregar una palabra de 5 letras a Wordix",
        "Salir"
    ];

    return $opciones;
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
        $puntaje = rand( 0, 24 );//el puntaje se da segun una norma dada, usar funcion

        $coleccionPartidas[] = [
            "palabraWordix" => $palabraWordix,
            "jugador" => $jugador,
            "puntaje" => $puntaje
        ];
    };

    // Retorna el arreglo con todas las partidas ya cargadas
    return $coleccionPartidas;
}

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Muestra menu de opciones disponibles
 * @param array $opcionesDisponibles = opciones disponibles para que el usuario elija
 * @return int
*/
function seleccionarOpcion( $opcionesDisponibles ){
    /*
        int:
            $cont = contador que puede incrementar su valor
            $opciónElegida = número de opción elegida por el usuario
    */
    
    echo "Seleccionar opción: \n";

    for( $cont = 1; $cont <= count( $opcionesDisponibles ); $cont++ ){
        echo "[$cont] " . $opcionesDisponibles[ $cont - 1 ] . "\n";
    };

    $opcionElegida = solicitarNumeroEntre(1, 8); //Función de wordix.php

    return $opcionElegida;
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
