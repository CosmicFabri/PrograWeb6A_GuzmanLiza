<?php

/* Arreglo que representa los elementos del juego. */
$elementos = [0 => "Piedra", 1 => "Papel", 2 => "Tijera", 3 => "Lagarto", 4 => "Spock"];

/* Arreglo que muestra cuáles elementos ganan a cuáles;
cada índice representa un elemento del juego. */
$vencedores = [0 => [2, 3], 1 => [0, 4], 2 => [1, 3], 3 => [1, 4], 4 => [0, 2]];

function evaluarGanador($mano1, $mano2) {

    global $vencedores;

    if (!is_numeric($mano1) || !is_numeric($mano2)) {

        echo "Por favor, ingrese números enteros como argumentos.\n";
    }

    // Buscamos en el arreglo valor del arreglo asociativo 'vencedores'
    // Correspondiente al índice $mano1
    foreach ($vencedores[$mano1] as $elemento) {

        if ($elemento == $mano2)
            return true; // El jugador 1 ha ganado
    }

    // Buscamos en el arreglo valor del arreglo asociativo 'vencedores'
    // Correspondiente al índice $mano2
    foreach ($vencedores[$mano2] as $elemento) {

        if ($elemento == $mano1)
            return false; // El jugador 2 ha ganado
    }
}

if (isset($argv[1]) && isset($argv[2])) {

    $mano1 = $argv[1];
    $mano2 = $argv[2];

    $ganador = evaluarGanador($mano1, $mano2);

    echo "Mano del jugador 1: {$elementos[$mano1]}\n";
    echo "Mano del jugador 2: {$elementos[$mano2]}\n";

    if ($ganador === true)
        echo "El jugador 1 ha ganado.\n";
    else
        echo "El jugador 2 ha ganado.\n";
} else {

    echo "Por favor, ingrese dos números enteros como argumentos.\n";
}