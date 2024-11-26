<?php
/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre - Legajo - Carrera - mail - Usuario Github */
/* Parra Joaquin -  FAI 5556 - TUDW - joaquinparra.nqn@gmail.com - joaquinparra2004 */
/* Britos Gabriel - FAI 5629 - TUDW - gabriel.britos.epet20@gmail.com - gBritos11 */

/**************************************/
/************* FUNCIONES **************/
/**************************************/

include_once("wordix.php");

/**************************************/
/***** Inicialización de variables ****/
/**************************************/

$coleccionPalabras = cargarColeccionPalabras();
$coleccionJugadores = cargarColeccionJugadores();
$coleccionPartidas = cargarColeccionPartidas( 2, $coleccionPalabras, $coleccionJugadores);

/**************************************/
/********* PROGRAMA PRINCIPAL *********/
/**************************************/

echo "¡BIENVENIDO A WORDIX!\n";

//LOGIN:

/*Pido al usuario que se logue*/
echo "Antes de comenzar a jugar deberás loguearte\n";
$jugador = solicitarJugador();

/*Verifico si está o no logueado*/
if ( buscarJugador( $coleccionJugadores, $jugador ) !== -1 ){
    
    echo "Nos alegra tenerte de vuelta $jugador\n";
}else{

    $coleccionJugadores = agregarJugador( $coleccionJugadores, $jugador );
    echo "Gracias por registrarte $jugador, nos divertiremos jugando!\n";
}



















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
