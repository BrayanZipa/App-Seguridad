<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ReportesExport implements FromView, ShouldAutoSize, WithTitle
{
    use Exportable;

    /**
    * @return \Illuminate\Support\View
    */
    public function __construct($consulta, $registrosCompletos, $esColaborador, $esColOrVisi, $titulo)
    {
        $this->consulta = $consulta;
        $this->registrosCompletos = $registrosCompletos;
        $this->esColaborador = $esColaborador;
        $this->esColOrVisi = $esColOrVisi;
        $this->titulo = $titulo;
    }

    public function view(): View
    {
        return view('pages.reportes.plantillaExportarExcel', 
        [   'reportes' => $this->consulta, 
            'registrosCompletos' => $this->registrosCompletos, 
            'esColaborador' => $this->esColaborador, 
            'esColOrVisi' => $this->esColOrVisi
        ]);
    }

    public function title(): string
    {
        return $this->titulo;
    }
}