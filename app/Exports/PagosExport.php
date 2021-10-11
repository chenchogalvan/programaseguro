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
        return ["id", "nombre", "paterno", "materno", "email", "phone", "birthday", "CURP", "NSS", "RFC", "estadoPago", "estadoSuscripcion", "fechaUltimoPago", "fechaVencimiento"];
    }

}
