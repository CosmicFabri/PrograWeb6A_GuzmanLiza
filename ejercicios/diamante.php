<?php

function imprimirDiamante($tamano) {
    
    if (!is_numeric($tamano) || $tamano <= 0) {
        echo "Por favor, ingrese un número entero positivo como argumento.\n";
        return;
    }

    // Imprimir el diamante
    for ($i = 1; $i <= $tamano; $i++) {

        // Imprimir espacios en blanco para la alineación
        echo str_repeat(" ", $tamano - $i);

        // Imprimir asteriscos para la parte superior del diamante
        echo str_repeat("* ", $i);

        echo "\n";
    }

    for ($i = $tamano - 1; $i >= 1; $i--) {

        // Imprimir espacios en blanco para la alineación
        echo str_repeat(" ", $tamano - $i);

        // Imprimir asteriscos para la parte inferior del diamante
        echo str_repeat("* ", $i);

        echo "\n";
    }
}

// Verificar si se proporcionó un argumento
if (isset($argv[1])) {

    // Obtener el número ingresado como argumento
    $tamano = intval($argv[1]);

    // Llamar a la función para imprimir el diamante
    imprimirDiamante($tamano);
} else {

    echo "Por favor, ingrese un número como argumento.\n";
}