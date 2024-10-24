<?php

namespace App\Exports;

use App\Models\Jugador;
use App\Models\Equipo;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class JugadoresExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithDrawings
{
    private $rowIndex = 2; // Para manejar el índice de fila y aplicar correctamente las imágenes

    public function collection()
    {
        return Equipo::with('jugadores')->get();
    }

    public function headings(): array
    {
        return [
            'Logotipo del Equipo',
            'Equipo',
            'Imagen del Jugador',
            'Nombres',
            'Apellidos',
            'Fecha de Nacimiento',
            'Creado el',
            'Última Actualización',
        ];
    }

    public function map($equipo): array
    {
        $rows = [];

        // Primera fila: solo el equipo, las otras columnas vacías
        $rows[] = [
            $equipo->imagen ? $equipo->imagen : '', // imagen del equipo
            $equipo->nombre, // Nombre del equipo
            '', // Imagen del jugador (vacío en fila de equipo)
            '', // Nombre jugador
            '', // Apellido jugador
            '', // Fecha nacimiento
            Carbon::parse($equipo->created_at)->setTimezone('America/Guatemala')->format('d-m-Y H:i:s'),
            Carbon::parse($equipo->updated_at)->setTimezone('America/Guatemala')->format('d-m-Y H:i:s'),
        ];

        foreach ($equipo->jugadores as $jugador) {
            $rows[] = [
                '', // imagen del equipo vacío
                '', // Nombre equipo vacío
                $jugador->imagen ? $jugador->imagen : '', // Imagen del jugador
                $jugador->nombre, // Nombre del jugador
                $jugador->apellido, // Apellido del jugador
                $jugador->fecha_nac, // Fecha de nacimiento
                Carbon::parse($jugador->created_at)->setTimezone('America/Guatemala')->format('d-m-Y H:i:s'),
                Carbon::parse($jugador->updated_at)->setTimezone('America/Guatemala')->format('d-m-Y H:i:s'),
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        // Ajustar ancho automático para todas las columnas
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        // Aplicar un estilo gris claro a las filas de los equipos
        $rowStyles = [];

        // Comenzamos en la fila 2, ya que la fila 1 tiene los encabezados
        $currentRow = 2;
        foreach ($this->collection() as $equipo) {
            $rowStyles[$currentRow] = [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E0E0E0'], // Color gris claro
                ]
            ];

            $sheet->getRowDimension($currentRow)->setRowHeight(50); // Altura específica para equipos

            // Incrementamos el número de filas según el número de jugadores en el equipo
            $currentRow += count($equipo->jugadores) + 1; // +1 por la fila del equipo
        }

        return $rowStyles + [
            1 => ['font' => ['bold' => true]], // Encabezados en negrita
        ];
    }

    public function drawings()
    {
        $drawings = [];

        $rowIndex = 2; // Comenzamos en la fila 2, ya que la fila 1 son los encabezados
        foreach ($this->collection() as $equipo) {
            // Imagen del equipo
            if ($equipo->imagen) {
                $drawing = new Drawing();
                $drawing->setName('imagen ' . $equipo->nombre);
                $drawing->setPath(public_path('imagen/' . $equipo->imagen)); // Asegúrate de que la imagen esté en la carpeta 'public/imagen'
                $drawing->setHeight(50); // Altura de la imagen
                $drawing->setCoordinates('A' . $rowIndex); // Columna A, fila actual
                $drawings[] = $drawing;
            }

            $rowIndex++; // Pasamos a la siguiente fila para los jugadores

            // Imagen de los jugadores
            foreach ($equipo->jugadores as $jugador) {
                if ($jugador->imagen) {
                    $drawing = new Drawing();
                    $drawing->setName('Imagen ' . $jugador->nombre);
                    $drawing->setPath(public_path('imagen/' . $jugador->imagen)); // Asegúrate de que la imagen esté en la carpeta 'public/imagen'
                    $drawing->setHeight(50); // Altura de la imagen
                    $drawing->setCoordinates('C' . $rowIndex); // Columna C, fila actual (donde está la imagen del jugador)
                    $drawings[] = $drawing;
                }

                $rowIndex++; // Pasamos a la siguiente fila para el próximo jugador
            }
        }

        return $drawings;
    }
}
