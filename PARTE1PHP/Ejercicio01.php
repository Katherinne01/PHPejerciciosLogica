<?php

function generarFibonacci($n){
    if ($n <= 0){
        return [];
       
    } elseif ($n == 1){
            return [0];
        }

        $fibonacci = [0 , 1];

        for ($i = 2; $i < $n; $i++){
            $fibonacci[$i]= $fibonacci [$i - 1] + $fibonacci[$i - 2];

        }
        return $fibonacci;

}

$n = 10;
$serie = generarFibonacci($n);
echo "Los primeros $n términos de la serie de Fibonacci son: ". implode (",", $serie);


?>