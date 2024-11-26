<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DECLARACIÓN DE CONSTANTES ******/
/**************************************/

/*
    Cantidad de intentos por cada partida
*/
const CANT_INTENTOS = 6;

/*
    ESTADOS DE LAS LETRAS:
        disponible => letra que aún no fue utilizada para adivinar la palabra
        encontrada => letra descubierta en el lugar que corresponde
        pertenece => letra descubierta, pero corresponde a otro lugar
        descartada => letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/****** DECLARACIÓN DE ARRAYS *********/
/**************************************/

/**
 * Función que inicia una estructura de datos 'teclado'. La estructura es de tipo asociativo
 * @return array - teclado inicializado con todas las letras en estado 'disponible'
*/
function iniciarTeclado()
{
    /*
        array:
            $teclado = arreglo asociativo, cuyas claves son las letras del alfabeto
    */

    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**************************************/
/************* MENSAJES ***************/
/**************************************/

/**
 * Función que muestra un mensaje de bienvenida al usuario
 * @param string $usuario - usuario
*/
function escribirMensajeBienvenida( $usuario )
{
    echo "***************************************************\n";
    echo "  Hola ";
    escribirAmarillo( $usuario );
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}

/**
 * Función que escribe en pantalla el estado del teclado con su respectivo color según el estado de cada letra.
 * Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado - teclado
*/
function escribirTeclado( $teclado )
{
    /*
        array:
            $ordenTeclado = arreglo indexado con el orden en que se debe escribir el teclado en pantalla
        
        string:
            $estado = almacena a cada letra junto a su estado

        int:
            $letra = posición del array $ordenTeclado junto a su respectivo valor
    */

    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ( $ordenTeclado as $letra ) {
        switch ( $letra ) {

            // Si encontramos "salto", hacemos un salto de línea
            case 'salto':
                echo "\n";
                break;

            default:
                $estado = $teclado[ $letra ];
                escribirSegunEstado( $letra, $estado );
                break;
        }
    }

    echo "\n";
};

/**
 * Función que escribe en pantalla los intentos del usuario para adivinar la palabra Wordix
 * @param array $estruturaIntentosWordix - arreglo que contiene los intentos realizados.
*/
function imprimirIntentosWordix( $estructuraIntentosWordix )
{
    /*
        int:
            $cantIntentosRealizados = cantidad de intentos realizados
            $cantIntentosFaltantes = cantidad de intentos faltantes
            $i, $j = contador que puede incrementar su valor

        array:
            $estructuraIntento = almacena cada intento por adivinar la palabra
            $intentoLetra = almacena cada letra y su respectivo estado de cada intento por adivinar la palabra
    */
    
    $cantIntentosRealizados = count( $estructuraIntentosWordix );
    $cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    // Mostramos los intentos ya realizados
    for ( $i = 0; $i < $cantIntentosRealizados; $i++ ) {

        $estructuraIntento = $estructuraIntentosWordix[ $i ];  // Obtenemos el intento en la posición $i
        echo "\n" . ( $i + 1 ) . ")  ";

        //escribo con el color según corresponda cada letra del intento de adivinar la palabra
        foreach ( $estructuraIntento as $intentoLetra ) {

            escribirSegunEstado( $intentoLetra[ "letra" ], $intentoLetra[ "estado" ] );
        }

        echo "\n";
    }

    // Mostramos los intentos faltantes
    for ( $i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++ ) {

        echo "\n" . ( $i + 1 ) . ")  ";

        // Mostramos cuadros grises para los intentos que aún no se han hecho
        for ( $j = 0; $j < 5; $j++ ) {

            escribirGris(" ");
        }
    }

    echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**************************************/
/*********** PINTAR TEXTOS ************/
/**************************************/

/** 
 * Escribir un texto en color ROJO
 * @param string $texto - texto que se desea pintar de rojo
*/
function escribirRojo( $texto )
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escribir un texto en color VERDE
 * @param string $texto - texto que se desea pintar de verde
*/
function escribirVerde( $texto )
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto - texto que se desea pintar de amarillo
*/
function escribirAmarillo( $texto )
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto - texto que se desea pintar de gris
*/
function escribirGris( $texto )
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto - texto que se desea mostrar en pantalla
*/
function escribirNormal( $texto )
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto - texto
 * @param string $estado - estado (disponible, encontrado, pertenece, descartada) del texto
*/
function escribirSegunEstado( $texto, $estado )
{
    switch ( $estado ) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal( $texto );
            break;

        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde( $texto );
            break;

        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo( $texto );
            break;

        case ESTADO_LETRA_DESCARTADA:
            escribirRojo( $texto );
            break;

        default:
            echo " $texto ";
            break;
    }
}

/**************************************/
/****** PEDIR DATOS AL USUARIO ********/
/**************************************/

/**
 * Función que solicita al usuario un número entero dentro de un rango específico
 * @param int $min - el límite inferior del rango válido
 * @param int  $max - el límite superior del rango válido
 * @return int - número en el rango solicitado
*/
function solicitarNumeroEntre( $min, $max )
{
    /*
        int:
            $numero = número ingresado por el usuario
    */

    echo "Ingrese un numero entre " . $min . " y " . $max . ": ";
    $numero = trim( fgets( STDIN ) );

    if ( is_numeric( $numero ) ) { // is_numeric() determina si un string es un número. Puede ser float o int.
        $numero  = $numero * 1; //con esta operación convierto el string en número.
    }

    // Ciclo que se repite mientras el número no sea válido , no sea entero y no este en el rango solicitado
    while ( !( is_numeric( $numero ) && ( ( $numero == ( int )$numero ) && ( $numero >= $min && $numero <= $max ) ) ) ) {

        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim( fgets( STDIN ) );

        // Verificar si la nueva entrada es un número
        if ( is_numeric( $numero ) ) {

            $numero  = $numero * 1;
        }
    }
    return $numero;
}

/**
 * Función que pide al usuario ingresar una palabra de 5 letras y retorna la palabra en mayúscula
 * @return string - palabra de 5 letras
*/
function leerPalabra5Letras()
{
    /*
        string:
            $palabra = palabra ingresada por el usuario
    */
    
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim( fgets( STDIN ) );
    $palabra  = strtoupper( $palabra ); //convierte las letras ingresadas en mayúscula

    //bucle que se repite mientras la palabra sea distinta a 5 letras o esPalabra() sea falso
    while ( ( strlen( $palabra ) != 5 ) || !esPalabra( $palabra ) ) { 

        echo "Debe ingresar una palabra de 5 letras: ";
        $palabra = strtoupper( trim( fgets( STDIN ) ) );
    }

    return $palabra;
}

/**************************************/
/*********** VERIFICACIONES ***********/
/**************************************/

/**
 * Función que recorre una cadena de texto y verifica si cada carácter es una letra
 * @param string $cadena - cadena que se desea verificar
 * @return boolean $esLetra - true si la cadena solo contiene carácteres alfabéticos. False caso contrario
*/
function esPalabra( $cadena )
{
    /*
        int:
            $cantCaracteres = cantidad de carácteres
            $i = contador

        boolean:
            $esLetra
    */

    $cantCaracteres = strlen( $cadena ); // strlen obtiene la cantidad de caracteres de la cadena

    $esLetra = true;
    $i = 0;

    // Bucle que recorre cada carácter de la cadena mientras no se haya encontrado un carácter no alfabético
    while ( $esLetra && $i < $cantCaracteres ) {
        
        $esLetra = ctype_alpha( $cadena[ $i ] ); // ctype_alpha()  verifica si el carácter actual en la posición $i es una letra

        $i++;
    }

    return $esLetra;
}

/**
 * Función que dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabraIntento.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix - palabra wordix
 * @param array $estruturaIntentosWordix - estructura que almacena la información de cada intento por adivinar la palabra
 * @param string $palabraIntento - palabra que ingreso el usuario intentando adivinar la palabra wordix
 * @return array - estructuraIntentosWordix modificada
*/
function analizarPalabraIntento( $palabraWordix, $estruturaIntentosWordix, $palabraIntento )
{
    /*
        int:
            $cantCaracteres = cantidad de caracteres de la palabra intento
            $i = contador

        array: 
            $estructuraPalabraIntento = almacena cada letra de la palabra intento con su estado

        string:
            $letraIntento = almacena un letra de la palabra intento
            $estado = almacena el estado de cada letra (descartada, encontrada, pertenece)

        boolean:
            $posicion
    */
    
    $cantCaracteres = strlen( $palabraIntento ); // Calculamos la cantidad de caracteres de la palabra del intento
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */

    // Recorrer cada letra de la palabra del intento
    for ( $i = 0; $i < $cantCaracteres; $i++ ) {  

        $letraIntento = $palabraIntento[ $i ]; // Tomamos la letra en la posición $i de la palabra intento
        $posicion = strpos( $palabraWordix, $letraIntento );  // Buscamos la posición de la letra en la palabra correcta

        //le asignamos un estado a cada letra de la palabra intento
        if ( $posicion === false ) {
            $estado = ESTADO_LETRA_DESCARTADA;

        } else { //si la letra se encuentra, obtiene un estado: 'encontrada' o 'pertenece'
            //si la letra coincide en posicion y caracter pasa a estado 'encontrada'
            if ( $letraIntento == $palabraWordix[ $i ] ) {
                $estado = ESTADO_LETRA_ENCONTRADA;

            } else {
                //en caso de que la letra coincida en caracter pero no en posicion pasa a estado 'pertenece'
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }

        // Almacenamos la letra y su estado en el array $estructuraPalabraIntento
        array_push( $estructuraPalabraIntento, [ "letra" => $letraIntento, "estado" => $estado ] );
    }

    /*se agrega un elemento al array $estruturaIntentosWordix.
    En este caso, cada elemento del array $estruturaIntentosWordix es un sub-array igual a $estructuraPalabraIntento,
    que representa cada intento del jugador de adivinar la palabra*/
    array_push( $estruturaIntentosWordix, $estructuraPalabraIntento );

    return $estruturaIntentosWordix;
}

/**
 * Función que actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado - teclado
 * @param array $estructuraPalabraIntento - estructura palabra intento
 * 
 * @return array $teclado - el teclado modificado con los cambios de estados.
*/
function actualizarTeclado( $teclado, $estructuraPalabraIntento )
{
    /*
        array:
            $letraIntento = toma el valor de las posiciones de $estructuraPalabraIntento
        
        string:
            $letra = letras de la palabraIntento
            $estados = estados de las letras
    */

    //recorro letra por letra la palabraIntento
    foreach ( $estructuraPalabraIntento as $letraIntento ) {

        $letra = $letraIntento[ "letra" ];
        $estado = $letraIntento[ "estado" ];

        //según el array $teclado en la posición $letra:
        switch ( $teclado[ $letra ] ) {

            //si la letra esta disponible le paso el estado
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[ $letra ] = $estado;
                break;

            //si el estado actual de la letra 'pertenece' verifico el estado nuevamente
            case ESTADO_LETRA_PERTENECE:

                //si el estado de la letra ahora es 'encontrada' le actualizo el estado
                if ( $estado == ESTADO_LETRA_ENCONTRADA ) {
                    $teclado[ $letra ] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si una palabra intento posee todas sus letras "Encontradas", por lo tanto, gano.
 * @param array $estructuraPalabraIntento
 * @return boolean
*/
function esIntentoGanado( $estructuraPalabraIntento ){
    /*
        int:
            $cantLetras = cantidad de letras de la palabraIntento
            $cont = contador
        boolean:
            $ganado
    */

    $cantLetras = count( $estructuraPalabraIntento );
    $cont = 0;

    //Mientras el cont sea menor que la cantidad de letras y el estado de la letra actual en el intento sea igual a "letra encontrada", sigue ejecutando.
    while ( $cont < $cantLetras && $estructuraPalabraIntento[ $cont ][ "estado" ] == ESTADO_LETRA_ENCONTRADA ) {
        $cont++;
    }

    //si cont es igual a la cantidad de letras es partida ganada
    if ( $cont == $cantLetras) {
        $ganado = true;

    } else {//sino sigue la partida
        $ganado = false;
    }

    return $ganado;
}

/**
 * Función que obtiene el puntaje de un jugador a partir de los intentos realizados y de la palabra wordix
 * @param int $intentos - intentos del jugador por adivinar la palabra wordix
 * @param string $palabraWordix - palabra wordix
 * @return int $puntaje - puntaje del jugador
 */
function obtenerPuntajeWordix( $intentos, $palabraWordix )  
{
    /*
        int:
            $puntaje = puntaje del jugador
            $i = contador
        
        string:
            $palabraSeparada = letras de la palabra wordix
        
        array:
            $abecedario = separa las letras del abecedario según cuanto vale su respectivo puntaje
    */

    if ( $intentos <= 6 ) {
        $puntaje = CANT_INTENTOS - $intentos; // siempre el puntaje va ser 1 punto menos que la cantidad de intentos
    } 
    else {
        $puntaje = 0; //sino puntaje es 0
    };

    if ( $puntaje > 0 ) { //Para determinar el puntaje según la letra
        $palabraSeparada = str_split($palabraWordix);  //str_split() dividide una cadena (string) en un arreglo de caracteres.
        $abecedario = [];
        $abecedario[ 0 ] = [ "A", "E", "I", "O", "U" ];
        $abecedario[ 1 ] = [ "B", "C", "D", "F", "G", "H", "J", "K", "L", "M" ];
        $abecedario[ 2 ] = [ "N", "Ñ", "P", "Q", "R", "S", "T", "V", "W", "X", "Y", "Z" ];

        //bucle que recorre cada letra
        for ( $i = 0; $i < 5; $i++ ) {

            //in_array verificar si la letra existe dentro deL arreglo $abcededario
            if ( in_array( $palabraWordix[ $i ], $abecedario[ 0 ] ) ) {
                $puntaje = $puntaje + 1; // si la letra esta en el abcedario 0 , suma 1 puntos
            } 
            else if ( in_array( $palabraSeparada[ $i ], $abecedario[ 1 ] ) ) {
                $puntaje = $puntaje + 2; // si la letra esta en el abcedario 1 , suma 2 puntos
            } 
            else {
                $puntaje = $puntaje + 3; // si la letra esta en el abcedario 2 , suma 3 puntos
            }
        }
    }
return $puntaje;
}

/**************************************/
/************ JUGAR WORDIX ************/
/**************************************/

/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array $partida - estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix( $palabraWordix, $nombreUsuario ){
    /*
        array:
            $arregloDeIntentosWordix = arreglos de los intentos
            $teclado = teclado
            $partida = estadisticas de la partida

        int: 
            $nroIntento = número de intento
            $indiceIntento = por cual intento va el jugador
            $puntaje = puntaje del jugador

        string:
            $palabraIntento = palabra con la que se intenta ganar

        boleean:
            $ganoElIntento
    */

    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida( $nombreUsuario );
    $nroIntento = 1;

    //repetir mientras el número de intentos sea menor o igual al permitido y no se haya ganado la partida
    do {
        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento( $palabraWordix, $arregloDeIntentosWordix, $palabraIntento );
        $teclado = actualizarTeclado( $teclado, $arregloDeIntentosWordix[ $indiceIntento ]);

        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix( $arregloDeIntentosWordix );
        escribirTeclado( $teclado );

        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */
        $ganoElIntento = esIntentoGanado( $arregloDeIntentosWordix[ $indiceIntento ] );
        $nroIntento++;

    } while ( $nroIntento <= CANT_INTENTOS && !$ganoElIntento );


    //si se gano la partida se imprime mensaje
    if ( $ganoElIntento ) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix( $indiceIntento, $palabraWordix );
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!";

    } else {

        //si se perdio la partida se imprime mensaje
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    //se guardan las estadisticas de la partida
    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}