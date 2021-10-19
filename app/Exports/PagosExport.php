<?php

namespace App\Exports;
use Carbon\Carbon;

use App\Models\Pago;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PagosExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

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
        return ["id", "nombre", "apellido paterno", "apellido materno", "email", "teléfono", "fecha de nacimiento", "CURP", "N° IMSS", "RFC", "Estado del pago", "estado de la suscripcion", "fecha del ultimo pago", "hora del ultimo pago", "fecha de vencimiento de la suscripción", "filtro"];
    }

}
