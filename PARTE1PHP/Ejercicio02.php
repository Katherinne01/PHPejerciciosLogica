<?php
// Función para determinar si un número es primo
function esPrimo($numero) {
    // Si el número es menor o igual a 1, no es primo
    if ($numero <= 1) {
        return false;
    }

    // Verificamos divisibilidad desde 2 hasta la raíz cuadrada del número
    for ($i = 2; $i <= sqrt($numero); $i++) {
        // Si el número es divisible por 'i', entonces no es primo
        if ($numero % $i == 0) {
            return false;
        }
    }

    // Si no encontramos divisores, el número es primo
    return true;
}

// Ejemplo de uso: Verificar si el número 29 es primo
$numero = 29;
if (esPrimo($numero)) {
    echo "$numero es un número primo.";
} else {
    echo "$numero no es un número primo.";
}
?>