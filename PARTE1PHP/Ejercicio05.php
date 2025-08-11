<?php

declare(strict_types=1);

/**
 * Calcula el costo de una llamada internacional según la zona y duración.
 */
class CalculadoraLlamadasInternacionales
{
    private const PRECIOS_POR_ZONA = [
        12 => ['nombre' => 'América del Norte', 'precio' => 2.00],
        15 => ['nombre' => 'América Central', 'precio' => 2.20],
        18 => ['nombre' => 'América del Sur', 'precio' => 4.50],
        19 => ['nombre' => 'Europa', 'precio' => 3.50],
        23 => ['nombre' => 'Asia', 'precio' => 6.00],
        25 => ['nombre' => 'África', 'precio' => 6.00],
        29 => ['nombre' => 'Oceanía', 'precio' => 5.00],
    ];

    private const DESCUENTO = 0.10; // 10% de descuento
    private const MIN_MINUTOS_DESCUENTO = 30;

    /**
     * Calcula el costo total de una llamada internacional.
     *
     * @param int $claveZona Clave numérica de la zona
     * @param float $minutos Duración de la llamada en minutos
     * @return array Resultado con detalles del cálculo
     * @throws InvalidArgumentException Si los parámetros son inválidos
     */
    public function calcularCosto(int $claveZona, float $minutos): array
    {
        $this->validarParametros($claveZona, $minutos);

        $precioMinuto = self::PRECIOS_POR_ZONA[$claveZona]['precio'];
        $costoBruto = $minutos * $precioMinuto;
        $descuentoAplicado = $this->calcularDescuento($minutos, $costoBruto);
        $costoNeto = $costoBruto - $descuentoAplicado;

        return [
            'zona' => self::PRECIOS_POR_ZONA[$claveZona]['nombre'],
            'clave' => $claveZona,
            'minutos' => $minutos,
            'precio_por_minuto' => $precioMinuto,
            'costo_bruto' => round($costoBruto, 2),
            'descuento' => round($descuentoAplicado, 2),
            'costo_neto' => round($costoNeto, 2),
        ];
    }

    private function validarParametros(int $claveZona, float $minutos): void
    {
        if ($minutos <= 0) {
            throw new InvalidArgumentException("Los minutos deben ser mayores a cero");
        }

        if (!array_key_exists($claveZona, self::PRECIOS_POR_ZONA)) {
            throw new InvalidArgumentException("Clave de zona no válida");
        }
    }

    private function calcularDescuento(float $minutos, float $costoBruto): float
    {
        return $minutos < self::MIN_MINUTOS_DESCUENTO 
            ? $costoBruto * self::DESCUENTO 
            : 0.0;
    }
}

// Ejemplo de uso
try {
    $calculadora = new CalculadoraLlamadasInternacionales();
    
    // Ejemplo 1: Llamada a América del Norte de 25 minutos (con descuento)
    $resultado1 = $calculadora->calcularCosto(12, 25);
    
    // Ejemplo 2: Llamada a Asia de 45 minutos (sin descuento)
    $resultado2 = $calculadora->calcularCosto(23, 45);
    
    // Mostrar resultados
    echo "Llamada a {$resultado1['zona']} ({$resultado1['minutos']} minutos):\n";
    echo "  Costo bruto: \${$resultado1['costo_bruto']}\n";
    echo "  Descuento: \${$resultado1['descuento']}\n";
    echo "  Costo neto: \${$resultado1['costo_neto']}\n\n";
    
    echo "Llamada a {$resultado2['zona']} ({$resultado2['minutos']} minutos):\n";
    echo "  Costo bruto: \${$resultado2['costo_bruto']}\n";
    echo "  Descuento: \${$resultado2['descuento']}\n";
    echo "  Costo neto: \${$resultado2['costo_neto']}\n";
    
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}