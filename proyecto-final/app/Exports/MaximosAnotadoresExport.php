<?php

namespace App\Exports;

use App\Models\Jugador;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MaximosAnotadoresExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    private $rowIndex = 2; // Para controlar el índice de las filas

    public function collection()
    {
        // Consulta para obtener los jugadores con sus puntos totales y detalles de jornadas y tipos de tiro
        return Jugador::with(['jornadas' => function ($query) {
            $query->select('jornadas.id', 'jornadas.nombre')
                ->withPivot('puntos_obtenidos', 'tipo_tiro');
        }])
            ->select('jugadores.*')
            ->get();
    }

    public function headings(): array
    {
        return [
            'JUGADOR',
            'TOTAL PUNTOS',
            'JORNADA',
            'TIPO DE TIRO',
            'PUNTOS OBTENIDOS',
        ];
    }

    public function map($jugador): array
    {
        $rows = [];
        $totalPuntos = $jugador->jornadas->sum(function ($jornada) {
            return $jornada->pivot->puntos_obtenidos; // Suma los puntos obtenidos en las jornadas
        });

        // Fila del jugador con el total de puntos
        $rows[] = [
            $jugador->nombre . ' ' . $jugador->apellido, // Nombre del jugador
            $totalPuntos, // Total de puntos
            '', // Jornada vacía (rellenaremos esto después)
            '', // Tipo de tiro vacío (rellenaremos esto después)
            '', // Puntos obtenidos vacíos (rellenaremos esto después)
        ];

        // Añadir filas por cada jornada
        foreach ($jugador->jornadas as $jornada) {
            $rows[] = [
                '', // Espacio para el nombre del jugador (dejar vacío para filas de jornada)
                '', // Espacio para total de puntos (dejar vacío para filas de jornada)
                $jornada->nombre, // Nombre de la jornada
                $jornada->pivot->tipo_tiro, // Tipo de tiro
                $jornada->pivot->puntos_obtenidos, // Puntos obtenidos
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        // Ajustar ancho automático para las columnas
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Encabezados en negrita
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        // Aplicar colores a las filas
        $rowStyles = [];
        $currentRow = 2; // Empezamos en la fila 2 (fila 1 son los encabezados)

        foreach ($this->collection() as $jugador) {
            // Color claro para la fila del jugador
            $rowStyles[$currentRow] = [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F0F0F0'], // Gris muy claro
                ]
            ];
            $currentRow++; // Pasamos a la fila siguiente (primer jornada)

            // Diferente tono de gris para cada jornada y sus subelementos
            foreach ($jugador->jornadas as $jornada) {
                $rowStyles[$currentRow] = [
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8E8E8'], // Otro tono de gris claro
                    ]
                ];
                $currentRow++;
            }
        }

        return $rowStyles;
    }
}
