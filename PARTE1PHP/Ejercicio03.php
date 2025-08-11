<?php
// Función para verificar si una cadena de texto es un palíndromo
function esPalindromo($cadena) {
    // Convertimos la cadena a minúsculas y quitamos espacios en blanco
    $cadena = strtolower(str_replace(' ', '', $cadena));

    // Invertimos la cadena
    $reversa = strrev($cadena);

    // Comparamos la cadena original con la cadena invertida
    return $cadena === $reversa;
}

// Ejemplo de uso: Verificar si una palabra o frase es palíndromo
$texto = "Anita lava la tina";
if (esPalindromo($texto)) {
    echo "'$texto' es un palíndromo.";
} else {
    echo "'$texto' no es un palíndromo.";
}
?>
