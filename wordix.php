<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/*
 * La funcion Solicita un número entre un valor mínimo y máximo al usuario.
 * Valida que el número ingresado sea un número entero dentro del rango especificado.
 * 
 * @PARAM INT $min
 * @PARAM INT $max 
 * @RETURN INT 
 */

function solicitarNumeroEntre($min, $max)
{
    //INT $numero 
    // Se declara la variable que almacenará el número ingresado por el usuario
    $numero = trim(fgets(STDIN)); 

    // is_numerc() verifica si el número ingresado es numérico
    if (is_numeric($numero)) {
        // Si es un número, lo convertimos a tipo numérico (puede ser un entero o flotante)
        $numero = $numero * 1; // Multiplicar por 1 convierte el valor a tipo numérico
    }

    // Se inicia el bucle que si no es un numero numerico, numero que no es entero y numero no esta entre min y max
    while (!(is_numeric($numero) && (($numero == (int)$numero) && ($numero >= $min && $numero <= $max)))) {
        // Si el número no es válido, se le solicita nuevamente al usuario un número dentro del rango
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        
        // Leer la entrada nuevamente
        $numero = trim(fgets(STDIN));

        // Verificar nuevamente si es un número
        if (is_numeric($numero)) {
            // Convertimos a número en caso de que haya sido ingresado como cadena
            $numero = $numero * 1;
        }
    }

    // Retorna el número válido
    return $numero;
}


/*
 * Escrbir un texto en color ROJO
 * @PARAM STRING  $texto
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/*
 * Escrbir un texto en color VERDE
 * @PARAM STRING $texto
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/*
 * Escrbir un texto en color AMARILLO
 * @PARAM STRING  $texto
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/*
 * Escrbir un texto en color GRIS
 * @PARAM STRING  $texto
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/*
 * Escrbir un texto pantalla.
 * @PARAM STRING  $texto
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/*
 * funcion que escribe un texto en pantalla teniendo en cuenta el estado.
 * @PARAM STRING $texto
 * @PARAM STRING $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/*
 * Funcion que muestra mensaje de bienvenida al usuario 
 * @PARAM STRING $usuario
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario); // llama a funcion escribirAmarillo()
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
    // BOOLEAN $esLetra
    // INT $i

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


/*
 * Funcion que inicia una estructura de datos Teclado. La estructura es de tipo:  asociativo
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

/*
 * funcion que escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
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

    // Recorremos cada tecla definida en el orden del teclado
    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                // Si encontramos "salto", hacemos un salto de línea
                echo "\n";
                break;
            default:
                // Si existe, se le asigna el valor asociado a esa clave; si no existe, se asigna un valor por defecto (en este caso, 'desactivada').
                $estado = isset($teclado[$letra]) ? $teclado[$letra] : 'desactivada';
                
                // Llamamos a la función escribirSegunEstado() para escribir la tecla según su estado
                escribirSegunEstado($letra, $estado);
                break;
        }
    }

    echo "\n";
};


/*
 * funcion que escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @PARAM ARRAY $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    //INT $cantIntentosRealizados,$cantIntentosFaltantes

    //cuenta cuantos intentos realizados hizo
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    //calcula intentos restantes
    $cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

   // Imprime los intentos realizados hasta el momento
    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        // Se imprime el número del intento, iniciando desde 1
        echo "\n" . ($i + 1) . ")  ";

        // Se recorre cada letra del intento, y se imprime con su estado
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }

        // Salto de línea al finalizar la impresión de un intento
        echo "\n";
    }

    // Imprime los intentos restantes que no han sido realizados
    for ($i = $cantIntentosRealizados; $i < 6; $i++) {
        // Imprime el número del intento, seguido de espacios vacíos para los intentos restantes
        echo "\n" . ($i + 1) . ")  ";

        // Imprime 5 espacios vacíos (una por cada letra en un intento)
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
    }
    echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/*
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @PARAM STRING $palabraWordix
 * @PARAM ARRAY $estruturaIntentosWordix
 * @PARAM STRING $palabraIntento
 * @RETURN ARRAY estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento);
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento);
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    return $estruturaIntentosWordix;
}

/*
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @PARAM ARRAY $teclado
 * @PARAM ARRAY $estructuraPalabraIntento
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

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * ****COMPLETAR***** documentación de la intefaz
 */
function obtenerPuntajeWordix()  /* ****COMPLETAR***** parámetros formales necesarios */
{

    /* ****COMPLETAR***** cuerpo de la función*/
    return 0;
}

/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
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
        $puntaje = obtenerPuntajeWordix();
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
