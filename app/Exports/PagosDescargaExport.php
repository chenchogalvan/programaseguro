<?php

namespace App\Exports;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PagosDescargaExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }


    public function headings(): array
    {
        return [
            'Nombre',
            'Paterno',
            'Materno',
            'Email',
            'N° IMSS',
            'Fecha De Pago',
            'Hora De Pago',
            'Tipo De Pago',
            'Monto',
            'Estatus De lPago',
            'ID Del Pago (Mercado Libre)',
        ];
    }
}
