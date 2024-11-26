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
$coleccionPartidas = cargarColeccionPartidas( 15, $coleccionPalabras, $coleccionJugadores);

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

//MENÚ PRINCIPAL:

/*Pido al usuario que elija una opcion*/
do{

    $opcion = seleccionarOpcion();
    echo "\n";

    switch ($opcion) {

        case 1: 

            //jugar wordix con una palabra elegida
            $totalPalabras = count($coleccionPalabras);

            echo "En total hay $totalPalabras disponibles para jugar\n";
            echo "Ingresar número de palabra para jugar\n";
            $numPalabraSeleccionada = solicitarNumeroEntre( 1, $totalPalabras );

            if ( palabraYaJugada( $coleccionPartidas, $jugador, $coleccionPalabras[ $numPalabraSeleccionada - 1 ] ) ){
                echo "¡$jugador ya jugaste con está palabra!";
            }else{
                $coleccionPartidas[] = jugarWordix( $coleccionPalabras[ $numPalabraSeleccionada - 1 ], $jugador );
            }

            break;

        case 2: 

            //jugar wordix con una palabra aleatoria
            $i = 0;

            do {

                $palabraSeleccionada = $coleccionPalabras[ array_rand( $coleccionPalabras ) ];
                $i++;

                // Si todos los intentos fallan, salir del bucle
                if ($i > $totalPalabras) {

                    echo "¡$jugador ya has jugado con todas las palabras disponibles!\n";
                    break;
                }
            } while( palabraYaJugada( $coleccionPartidas, $jugador, $palabraSeleccionada ) );

            if ($i <= $totalPalabras) {
                $coleccionPartidas[] = jugarWordix($palabraSeleccionada, $jugador);
            }
            
            break;

        case 3: 
            
            //mostrar partida solicitada
            mostrarPartida( $coleccionPartidas );
            break;

        case 4:

            //mostrar la primer partida ganada
            echo mostrarJugadores( $coleccionJugadores );

            echo "Ingresar de quien deseas ver la primer partida ganada\n";
            $numJugador = solicitarNumeroEntre( 1, count( $coleccionJugadores ) );
            echo "\n";

            $numPrimerPartidaGanada = primeraPartidaGanada( $coleccionPartidas, $coleccionJugadores[ $numJugador - 1 ] );

            if ( $numPrimerPartidaGanada == -1 ){
                echo "el jugador " . $coleccionJugadores[ $numJugador - 1 ] . " no gano ninguna partida\n";
            }else{
                echo mensajeMostrarPartida( $numPrimerPartidaGanada, $coleccionPartidas[$numPrimerPartidaGanada]["palabraWordix"], $coleccionPartidas[$numPrimerPartidaGanada]["jugador"], $coleccionPartidas[$numPrimerPartidaGanada]["puntaje"], $coleccionPartidas[$numPrimerPartidaGanada]["intentos"]);
            }
            break;

        case 5:

            //mostrar estadisticas del jugador
            echo mostrarJugadores( $coleccionJugadores );

            echo "Ingresar de quien deseas ver el resumen\n";
            $numJugador = solicitarNumeroEntre( 1, count( $coleccionJugadores ) );
            echo "\n";

            $resumen = obtenerResumenJugador( $coleccionPartidas, $coleccionJugadores[ $numJugador - 1 ] );

            foreach ($resumen as $clave => $valor) {
                echo "$clave: $valor\n";
            }
            break;

        case 6:

           //mostrar partidas ordenadas por jugador y palabra
           echo mostrarPartidasOrdenadas($coleccionPartidas);
           break;
            
        case 7:

           //agregar una palabra de 5 letras
           $palabra = leerPalabra5Letras();
           $coleccionPalabras = agregarPalabra( $palabra, $coleccionPalabras );
           break;
    }
}while( $opcion != 8);