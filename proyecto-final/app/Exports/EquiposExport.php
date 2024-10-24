<?php

namespace App\Exports;

use App\Models\Equipo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EquiposExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithStyles
{
    private $imagenes = [];

    public function collection()
    {
        return Equipo::select('id', 'nombre', 'imagen', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nombre',
            'Imagen',
            'Fecha de Creación',
            'Última Actualización',
        ];
    }

    public function map($equipo): array
    {
        $this->imagenes[] = $equipo->imagen;
        static $id = 0;
        $id++;

        return [
            $id,
            $equipo->nombre,
            '', // Imagen será añadida más tarde en el método `drawings()`
            Carbon::parse($equipo->created_at)->setTimezone('America/Guatemala')->format('d-m-Y H:i:s'),
            Carbon::parse($equipo->updated_at)->setTimezone('America/Guatemala')->format('d-m-Y H:i:s'),
        ];
    }

    public function drawings()
    {
        $drawings = [];

        foreach ($this->imagenes as $index => $imagen) {
            $imagePath = public_path('imagen/' . $imagen);

            if (file_exists($imagePath)) {
                $drawing = new Drawing();
                $drawing->setName('Imagen del Equipo ' . ($index + 1));
                $drawing->setDescription('Imagen del equipo');
                $drawing->setPath($imagePath);
                $drawing->setHeight(60); // Establece una altura consistente para las imágenes
                $drawing->setCoordinates('C' . ($index + 2)); // Coloca la imagen en la columna C

                // Ajusta el ancho de la columna C para que se ajuste al tamaño de la imagen
                $drawings[] = $drawing;
            } else {
                Log::warning("La imagen no se encontró en la ruta: " . $imagePath);
            }
        }

        return $drawings;
    }

    public function styles(Worksheet $sheet)
    {
        // Ajuste automático del ancho de todas las columnas
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Ajuste manual para la columna de imágenes para que tenga suficiente espacio
        $sheet->getColumnDimension('C')->setWidth(20); // Ajusta el ancho de la columna C

        // Ajustar la altura de las filas para que las imágenes quepan bien
        for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
            $sheet->getRowDimension($i)->setRowHeight(60); // Ajusta la altura de la fila
        }

        return [
            1 => ['font' => ['bold' => true]], // Negrita para los encabezados
        ];
    }
}
