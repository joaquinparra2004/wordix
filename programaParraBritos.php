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

/*********** FUNCION 1  **************/
/*
 * Funcion que obtiene un arreglo indexado de una colección de palabras
 * @RETURN ARRAY
*/
function cargarColeccionPalabras(){
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "TENIS", "POLLO", "LLAVE", "ARBOL", "JAMON",
        "TECLA", "HORAS", "PATOS", "VODKA"
    ];

    return $coleccionPalabras;
}

/*********** FUNCION 2  **************/
/*
 * Funcion que obtiene una arreglo multidimensional de las partidas ya jugadas
 * @RETURN ARRAY
 */
function cargarPartidas()
{
    $coleccionPartidas = [];
    // Asignar las palabras y los datos dentro del arreglo coleccionPartidas
    $coleccionPartidas[0] = ["palabraWordix" => "GATOS", "jugador" => "joaquin", "intentos" => 2, "puntaje" => 0];
    $coleccionPartidas[1] = ["palabraWordix" => "MOUSE", "jugador" => "ana", "intentos" => 3, "puntaje" => 5];
    $coleccionPartidas[2] = ["palabraWordix" => "TECLA", "jugador" => "pedro", "intentos" => 4, "puntaje" => 10];
    $coleccionPartidas[3] = ["palabraWordix" => "SOLAR", "jugador" => "luisa", "intentos" => 5, "puntaje" => 8];
    $coleccionPartidas[4] = ["palabraWordix" => "LARGO", "jugador" => "carla", "intentos" => 6, "puntaje" => 3];
    $coleccionPartidas[5] = ["palabraWordix" => "CIELO", "jugador" => "juan", "intentos" => 1, "puntaje" => 12];
    $coleccionPartidas[6] = ["palabraWordix" => "NUEVO", "jugador" => "lucas", "intentos" => 6, "puntaje" => 7];
    $coleccionPartidas[7] = ["palabraWordix" => "ARBOL", "jugador" => "maria", "intentos" => 3, "puntaje" => 15];
    $coleccionPartidas[8] = ["palabraWordix" => "VIAJE", "jugador" => "pedro", "intentos" => 2, "puntaje" => 6];
    $coleccionPartidas[9] = ["palabraWordix" => "SALTA", "jugador" => "marta", "intentos" => 4, "puntaje" => 9];
    $coleccionPartidas[10] = ["palabraWordix" => "FRUTA", "jugador" => "camila", "intentos" => 5, "puntaje" => 4];
    $coleccionPartidas[11] = ["palabraWordix" => "CIEGA", "jugador" => "roberto", "intentos" => 1, "puntaje" => 11];
    $coleccionPartidas[12] = ["palabraWordix" => "PUNTO", "jugador" => "pedro", "intentos" => 6, "puntaje" => 2];
    $coleccionPartidas[13] = ["palabraWordix" => "VODKA", "jugador" => "diana", "intentos" => 3, "puntaje" => 1];
    $coleccionPartidas[14] = ["palabraWordix" => "ARBOL", "jugador" => "luis", "intentos" => 5, "puntaje" => 13];
    $coleccionPartidas[15] = ["palabraWordix" => "CAMPO", "jugador" => "joaquin", "intentos" => 4, "puntaje" => 14];
    // Retorna el arreglo con todas las partidas
    return $coleccionPartidas;
}


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/*********** FUNCION 3  **************/
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

/*********** FUNCION 6 (PARTE 1) **************/

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

/*********** FUNCION 6 (PARTE 2 -FINAL)  **************/

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


/*********** FUNCION 7  **************/

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


/*********** FUNCION 10 **************/

/*
 * Funcion que  pide al usuario , ingresar su nombre de jugador. 
 * valida que comienze con una letra y lo convierte en minúsculas
 * @RETURN STRING $nombreUsuario
 */
function solicitarJugador()
{
    //STRING $nombreUsuario, $primeraLetra

    echo "Ingrese nombre de usuario: \n";
    do {
        $nombreUsuario = trim(fgets(STDIN));

        // Verificar si el nombre tiene solo letras
        $primeraLetra = $nombreUsuario[0];
        if (!ctype_alpha($primeraLetra)) { // ctype_alpha() verifica si la primera letra  son letras alfabéticas (ya sean minúsculas o mayúsculas) 
            echo "Su nombre debe comenzar con una letra, ingrese un nombre válido: \n";
        }
    } while (!ctype_alpha($primeraLetra));

    $nombreUsuario = strtolower($nombreUsuario); // strtolower() convierte en minúsculas la palabra
    return $nombreUsuario;
}


/*********** FUNCION 8 **************/

/*
 * Funcion que busca la primera partida ganada de un usuario y devuelve el indice de la partida. 
 * De no haber ganado ninguna, devuelve el valor -1
 * @PARAM ARRAY $partidasPredefinidas
 * @PARAM STRING $nombreUsuario 
 * @RETURN INT
 */
function primeraPartidaGanada($partidasPredefinidas, $nombreUsuario)
{
    //int $indice
    $indice = 0;
    $partidaGanada = false ;
    $cantPartidas = count($partidasPredefinidas);

    // Iniciamos un bucle para revisar cada partida
    while($indice < $cantPartidas && !$partidaGanada){

        // Verificamos si el nombre del jugador coincide y si el puntaje es mayor que 0 (es decir, ganó la partida)
        if ($nombreUsuario == $partidasPredefinidas[$indice]["jugador"] && $partidasPredefinidas[$indice]["puntaje"] > 0) {
            // si partidaGanada es true sale del bulce y toma el ultimo valor del indice
           $partidaGanada = true ;
        } else {
            $indice = $indice + 1;
        }
    }
    // Si no se encontró ninguna partida ganada, devolvemos -1
    if (!$partidaGanada) {
        $indice = -1 ;
    }
    return $indice;
}

/*********** FUNCION 9 **************/

/**
 * Retorna el resumen de un jugador basado en la colección de partidas.
 * @param array $coleccionPartidas
 * @param string $nombreJugador
 * @return array
*/
function obtenerResumenJugador($coleccionPartidas, $nombreJugador) {
    // Inicializar el resumen del jugador.
    $resumen = [
        "jugador" => $nombreJugador,
        "partidas" => 0,
        "puntaje" => 0,
        "victorias" => 0,
        "intento1" => 0,
        "intento2" => 0,
        "intento3" => 0,
        "intento4" => 0,
        "intento5" => 0,
        "intento6" => 0
    ];

    // Recorrer la colección de partidas.
    foreach ($coleccionPartidas as $partida) {
        if ($partida["jugador"] === $nombreJugador) {
            // Incrementar el número de partidas jugadas.
            $resumen["partidas"]++;

            // Sumar el puntaje al total.
            $resumen["puntaje"] += $partida["puntaje"];

            // Si el puntaje es mayor a 0, es una victoria.
            if ($partida["puntaje"] > 0) {
                $resumen["victorias"]++;

                // Determinar en qué intento se ganó.
                switch ($partida["intentos"]) {
                    case 6: $resumen["intento1"]++; break;
                    case 5: $resumen["intento2"]++; break;
                    case 4: $resumen["intento3"]++; break;
                    case 3: $resumen["intento4"]++; break;
                    case 2: $resumen["intento5"]++; break;
                    case 1: $resumen["intento6"]++; break;
                }
            }
        }
    }

    return $resumen;
}

/*********** FUNCION 11 **************/

/**
 * Muestra la colección de partidas ordenada por el nombre del jugador y luego por la palabra.
 * @param array $coleccionPartidas Colección de partidas a ordenar y mostrar
*/
function mostrarPartidasOrdenadas($coleccionPartidas) {

    // Ordenar la colección por jugador y palabra usando uasort
    uasort($coleccionPartidas, function($a, $b) {
        // Comparar por jugador
        $comparacionJugador = strcmp($a['jugador'], $b['jugador']);
        
        // Si los jugadores son iguales, comparar por palabra
        if ($comparacionJugador === 0) {
            return strcmp($a['palabraWordix'], $b['palabraWordix']);
        }
        
        // Retornar la comparación por jugador
        return $comparacionJugador;
    });

    // Mostrar la colección ordenada
    print_r($coleccionPartidas);
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
