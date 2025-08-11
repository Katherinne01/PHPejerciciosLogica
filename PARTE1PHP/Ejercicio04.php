<?php

/**
 * Suma todos los números pares en un array de enteros.
 *
 * @param array $numeros Array de números enteros
 * @return int La suma de todos los números pares
 * @throws InvalidArgumentException Si el array contiene elementos no numéricos
 */
function sumarNumerosPares(array $numeros): int
{
    $suma = 0;
    
    foreach ($numeros as $numero) {
        if (!is_int($numero)) {
            throw new InvalidArgumentException("El array debe contener solo números enteros");
        }
        
        if ($numero % 2 === 0) {
            $suma += $numero;
        }
    }
    
    return $suma;
}

// Ejemplo de uso
try {
    $arrayEjemplo = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $resultado = sumarNumerosPares($arrayEjemplo);
    
    echo "La suma de números pares en el array es: " . $resultado . "\n";
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}