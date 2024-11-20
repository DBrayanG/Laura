<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Producto;
use App\Models\PedidoDetalle;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function generarPDF()
    {
        $this->fpdf->AddPage();

        // Título y descripción del reporte
        $this->fpdf->SetFont('Arial', 'B', 16);
        $this->fpdf->Cell(0, 10, 'Reporte de Productos', 0, 1, 'C'); // Ancho 0 para ocupar toda la página
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->MultiCell(0, 10, 'Productos con la cantidad en Inventario y su Monto Total', 0, 'C');

        // Cabecera de la tabla
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(50, 10, 'Nombre', 1);
        $this->fpdf->Cell(65, 10, 'Descripcion', 1);
        $this->fpdf->Cell(25, 10, 'Cantidad', 1);
        $this->fpdf->Cell(25, 10, 'Precio', 1);
        $this->fpdf->Cell(25, 10, 'Monto', 1);
        $this->fpdf->Ln();

        // Datos de la tabla (obtener datos de la base de datos)
        $productos = Producto::getAllProductos(); // Obtener todos los productos

        $this->fpdf->SetFont('Arial', 'B', 9);

        foreach ($productos as $producto) {
             // Establecer coordenadas actuales
             $x = $this->fpdf->GetX();
             $y = $this->fpdf->GetY();
              
             // Establecer el ancho de cada celda
             $nombreWidth = 50;
             $descripcionWidth = 65;
             $cantidadWidth = 25;
             $precioWidth = 25;
             $montoWidth = 25;
 
              // Establecer el contenido para cada celda
            $nombre = $producto->nombre;
            $descripcion = $producto->descripcion;
            $cantidad = $producto->cantidad;
            $precio = $producto->precio;   
            $monto = $producto->precio * $producto->cantidad;          
 
             // Obtener la altura máxima necesaria para la fila actual
            $alturaMaxima = max(
                $this->getStringHeight($nombre, $nombreWidth),
                $this->getStringHeight($descripcion, $descripcionWidth),
                $this->getStringHeight($cantidad, $cantidadWidth),
                $this->getStringHeight($precio, $precioWidth),
                $this->getStringHeight($monto, $montoWidth)
            );

            // Dibujar las celdas con el alto máximo calculado
            $this->fpdf->SetXY($x, $y);
            if($this->fpdf->GetStringWidth($nombre) > $nombreWidth)
                $this->fpdf->MultiCell($nombreWidth, $alturaMaxima/2, utf8_decode($nombre), 1);
            else
                $this->fpdf->MultiCell($nombreWidth, $alturaMaxima, utf8_decode($nombre), 1);

            $this->fpdf->SetXY($x + $nombreWidth, $y);
            if($this->fpdf->GetStringWidth($descripcion) > $descripcionWidth)
                $this->fpdf->MultiCell($descripcionWidth, $alturaMaxima/2, utf8_decode($descripcion), 1);
            else
                $this->fpdf->MultiCell($descripcionWidth, $alturaMaxima, utf8_decode($descripcion), 1);

            $this->fpdf->SetXY($x + $nombreWidth + $descripcionWidth, $y);
            $this->fpdf->MultiCell($cantidadWidth, $alturaMaxima, utf8_decode($cantidad), 1);

            $this->fpdf->SetXY($x + $nombreWidth + $descripcionWidth + $cantidadWidth, $y);
            $this->fpdf->MultiCell($precioWidth, $alturaMaxima, utf8_decode($precio), 1);

            $this->fpdf->SetXY($x + $nombreWidth + $descripcionWidth + $cantidadWidth + $precioWidth, $y);
            $this->fpdf->MultiCell($montoWidth, $alturaMaxima, utf8_decode($monto), 1);

            // Mover a la siguiente fila
            $this->fpdf->SetY($y + $alturaMaxima);
        }

        $this->fpdf->Output();

        exit;
    }

    public function generarPDF2()
    {
        $this->fpdf->AddPage();

        // Título y descripción del reporte
        $this->fpdf->SetFont('Arial', 'B', 16);
        $this->fpdf->Cell(0, 10, 'Reporte de Pedidos', 0, 1, 'C'); // Ancho 0 para ocupar toda la página
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial', '', 12);
        $this->fpdf->MultiCell(0, 10, 'Productos vendidos con cantidad en orden ascendente', 0, 'C');

        // Cabecera de la tabla
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(50, 10, 'Nombre', 1);
        $this->fpdf->Cell(80, 10, 'Descripcion', 1);
        $this->fpdf->Cell(30, 10, 'Cantidad', 1);
        $this->fpdf->Ln();

        // Datos de la tabla (obtener datos de la base de datos)
        $productos = PedidoDetalle::GetSumaCantidadProductosPedidos(); // Obtener todos los productos

        $this->fpdf->SetFont('Arial', 'B', 9);

        foreach ($productos as $producto) {
             // Establecer coordenadas actuales
             $x = $this->fpdf->GetX();
             $y = $this->fpdf->GetY();
              
             // Establecer el ancho de cada celda
             $nombreWidth = 50;
             $descripcionWidth = 80;
             $cantidadWidth = 30;
 
              // Establecer el contenido para cada celda
            $prod = Producto::GetProducto($producto->producto_id);
            $nombre = $prod->nombre;
            $descripcion = $prod->descripcion;
            $cantidad = $producto->total_cantidad;      
 
             // Obtener la altura máxima necesaria para la fila actual
            $alturaMaxima = max(
                $this->getStringHeight($nombre, $nombreWidth),
                $this->getStringHeight($descripcion, $descripcionWidth),
                $this->getStringHeight($cantidad, $cantidadWidth)
            );

            // Dibujar las celdas con el alto máximo calculado
            $this->fpdf->SetXY($x, $y);
            if($this->fpdf->GetStringWidth($nombre) > $nombreWidth)
                $this->fpdf->MultiCell($nombreWidth, $alturaMaxima/2, utf8_decode($nombre), 1);
            else
                $this->fpdf->MultiCell($nombreWidth, $alturaMaxima, utf8_decode($nombre), 1);

            $this->fpdf->SetXY($x + $nombreWidth, $y);
            if($this->fpdf->GetStringWidth($descripcion) > $descripcionWidth)
                $this->fpdf->MultiCell($descripcionWidth, $alturaMaxima/2, utf8_decode($descripcion), 1);
            else
                $this->fpdf->MultiCell($descripcionWidth, $alturaMaxima, utf8_decode($descripcion), 1);

            $this->fpdf->SetXY($x + $nombreWidth + $descripcionWidth, $y);
            $this->fpdf->MultiCell($cantidadWidth, $alturaMaxima, utf8_decode($cantidad), 1);

            // Mover a la siguiente fila
            $this->fpdf->SetY($y + $alturaMaxima);
        }

        $this->fpdf->Output();

        exit;
    }

    function getStringHeight($text, $width) {
        $fontFamily = "Arial";
        $fontSize = 9;

        // Obtenemos la anchura del texto en función de la fuente actual
        $textWidth = $this->fpdf->GetStringWidth($text);

        // Calculamos la cantidad de líneas que necesitará el texto en función del ancho de la celda
        $numLines = ceil($textWidth / $width);

        // Calculamos la altura aproximada multiplicando el número de líneas por la altura de la fuente
        $height = $numLines * $fontSize;

        return $height;
    }

}
