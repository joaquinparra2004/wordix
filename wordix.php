<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
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

/*
 * Funcion que inicia una estructura de datos Teclado. La estructura es de tipo asociativo
 * @RETURN ARRAY
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
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

/*********** FUNCION 3 Y 5  **************/
/*
 * funcion que solicita al usuario un número entero dentro de un rango específico.
 * el valor ingresado debe ser un número entero, y debe estar entre los valores de $min y $max.
 *
 * @PARAM INT $min, el límite inferior del rango válido.
 * @PARAM INT  $max, el límite superior del rango válido.
 * @RETURN INT 
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero
    echo "Ingrese un numero entre " . $min . " y " . $max . ": ";
    $numero = trim(fgets(STDIN));

    if (is_numeric($numero)) { // is_numeric() determina si un string es un número. puede ser float como entero.
        $numero  = $numero * 1; //con esta operación convierto el string en número.
    }

    // Ciclo que se repite mientras el número, ni sea un numero numerico válido , no sea numero entero y no este entre el minimo y el maximo
    while (!(is_numeric($numero) && (($numero == (int)$numero) && ($numero >= $min && $numero <= $max)))) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));

        // Verificar si la nueva entrada es un número
        if (is_numeric($numero)) {
            $numero  = $numero * 1;
        }
    }
    return $numero;
}

/*********** FUNCION 4  **************/
/*
 * Funcion que pide al usuario ingresar palabra de 5 letras y retorna la palabra en mayuscula
 * @RETURN STRING
 */
function leerPalabra5Letras()
{
    //STRING $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra); //convierte las letras ingresadas en mayuscula

    //bucle que mientras la palabra sea distinta a 5 letras o esPalabra() sea falso entonces ingresara de nuevo una palabra
    while ((strlen($palabra) != 5) || !esPalabra($palabra)) { 
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }

    return $palabra;
}


/**************************************/
/*********** PINTAR TEXTOS ************/
/**************************************/


/*
 * Escrbir un texto en color ROJO
 * 
 * @PARAM STRING $texto
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/*
 * Escrbir un texto en color VERDE
 * 
 * @PARAM STRING $texto
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/*
 * Escrbir un texto en color AMARILLO
 * 
 * @PARAM STRING $texto
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/*
 * Escrbir un texto en color GRIS
 * 
 * @PARAM STRING $texto
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/*
 * Escrbir un texto pantalla.
 * 
 * @PARAM STRING $texto
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/*
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * 
 * @PARAM STRING $texto
 * @PARAM STRING $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
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
/************* MENSAJES ***************/
/**************************************/

/*
 * funcion que muestra un mensaje de bienvenida al usuario
 * @PARAM STRING $usuario
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "  Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}


/*
 * Función que recorre una cadena de texto y verifica si cada carácter es una letra
 * @PARAM INT $texto
 * @RETURN 
 */
function esPalabra($cadena)
{
    $cantCaracteres = strlen($cadena); // strlen obtiene la cantidad de caracteres de la cadena

    $esLetra = true;
    $i = 0;

    // Bucle que recorre cada carácter de la cadena mientras no se haya encontrado un carácter no alfabético
    while ($esLetra && $i < $cantCaracteres) {
        
        $esLetra = ctype_alpha($cadena[$i]); // ctype_alpha()  verifica si el carácter actual en la posición $i es una letra

        $i++;
    }

    // Si la cadena contiene solo letras, $esLetra será true; si no, será false
    return $esLetra;
}



/*
 * Funcion que escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @PARAM ARRAY $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                // Si encontramos "salto", hacemos un salto de línea
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }

    echo "\n";
};

/*
 * Funcion que escribe en pantalla los intentos de Wordix para adivinar la palabra
 * 
 * @PARAM ARRAY $estruturaIntentosWordix,  arreglo que contiene los intentos realizados.
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    $cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

      // Mostramos los intentos ya realizados
    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];  // Obtenemos el intento en la posición $i
        echo "\n" . ($i + 1) . ")  "; // Mostramos el número de intento
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }

        // Salto de línea al finalizar la impresión de un intento
        echo "\n";
    }

    // Mostramos los intentos faltantes
    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");// Mostramos 5 cuadros grises para los intentos que aún no se han hecho
        }
    }
    echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/*
 * Funcion que dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * 
 * @PARAM STRING $palabraWordix
 * @PARAM ARRAY $estruturaIntentosWordix
 * @PARAM STRING $palabraIntento
 * 
 * @RETURN ARRAY estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento); // Calculamos la cantidad de caracteres de la palabra del intento
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */

    // Recorrer cada letra de la palabra del intento
    for ($i = 0; $i < $cantCaracteres; $i++) {  
        $letraIntento = $palabraIntento[$i]; // Tomamos la letra en la posición $i de la palabra del intento
        $posicion = strpos($palabraWordix, $letraIntento);  // Buscamos la posición de la letra en la palabra correcta
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;

        } else { //si la letra estimativa se encuentra, obtiene un estado: 'encontrada' o 'pertenece'
            //si la letra estimativa coincide en posicion y caracter pasa a estado 'encontrada'
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;

            } else {
                //en caso de que la letra coincida en caracter pero no en posicion pasa a estado 'pertenece'
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }

        // Almacenamos la letra y su estado en el array $estructuraPalabraIntento
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
    }

    /*se agrega un elemento al array $estruturaIntentosWordix.
    En este caso, cada elemento del array $estruturaIntentosWordix es un sub-array igual a $estructuraPalabraIntento,
    que representa cada intento del jugador de adivinar la palabra*/
    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);

    return $estruturaIntentosWordix;
}


/*
 * funcion que actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * 
 * @PARAM ARRAY $teclado
 * @PARAM ARRAY $estructuraPalabraIntento
 * 
 * @RETURN ARRAY el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}


/*
 * funcion que determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @PARAM ARRAY $estructuraPalabraIntento
 * @RETURN BOOLEAN
 */
function esIntentoGanado($estructuraPalabraIntento)
{
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;
    
    // Verificar si todas las letras están en la posición correcta
    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true; //si todas las letras coinciden
    } else {
        $ganado = false; //si todas las letras no coinciden
    }

    return $ganado; // retorna si gano o no 
}


/*
 * Funcion que obtiene el puntaje de un jugador a partir de intentos realizados
 * @PARAM INT $intentos
 * @PARAM STRING $palabra
 * @RETURN INT
 */
function obtenerPuntajeWordix($intentos, $palabra)  
{
    //INT $puntaje
    //ARRAY $abecedario
    if ($intentos <= 6) {
        $puntaje = CANT_INTENTOS - $intentos; // siempre el puntaje va ser 1 punto menos que la cantidad de intentos
    } 
    else {
        $puntaje = 0; //sino puntaje es 0
    };

    if ($puntaje > 0) { //Para determinar el puntaje según la letra
        $palabraSeparada = str_split($palabra);  //str_split() dividide una cadena (string) en un arreglo de caracteres.
        $abcededario = [];
        $abecedario[0] = ["A", "E", "I", "O", "U",];
        $abecedario[1] = ["B", "C", "D", "F", "G", "H", "J", "K", "L", "M"];
        $abecedario[2] = ["N", "Ñ", "P", "Q", "R", "S", "T", "V", "W", "X", "Y", "Z"];
        //bucle que recorre cada letra
        for ($i = 0; $i < 5; $i++) {

            //in_array verificar si la letra existe dentro deL arreglo $abcededario
            if (in_array($palabra[$i], $abecedario[0])) {
                $puntaje = $puntaje + 1; // si la letra esta en el abcedario 0 , suma 1 puntos
            } 
            else if (in_array($palabraSeparada[$i], $abecedario[1])) {
                $puntaje = $puntaje + 2; // si la letra esta en el abcedario 1 , suma 2 puntos
            } 
            else {
                $puntaje = $puntaje + 3; // si la letra esta en el abcedario 2 , suma 3 puntos
            }
        }
    }
return $puntaje;
}


/*
 * funcion que dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * 
 * @PARAM STRING $palabraWordix
 * 
 * @PARAM STRING $nombreUsuario
 * @RETURN ARRAY estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida($nombreUsuario);
    $nroIntento = 1;
    do {

        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix($nroIntento,$palabraWordix);
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!";
    } else {
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}
