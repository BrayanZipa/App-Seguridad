<?php

namespace App\Exports;

use App\Models\Registro;
use Maatwebsite\Excel\Concerns\Exportable;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportesExport implements FromView, ShouldAutoSize
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function query()
    // {
    //     return Registro::query()->select('se_registros.*', 'personas.nombre', 'personas.apellido', 'personas.identificacion', 'personas.tel_contacto', 'personas.email', 'personas.id_tipo_persona')
    //         ->leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas');

    //         // select('se_registros.*', 'personas.nombre', 'personas.apellido', 'personas.identificacion', 'personas.tel_contacto', 'personas.email', 'personas.id_tipo_persona', 'tpersona.tipo AS tipopersona', 'personas.foto', 'eps.eps', 'arl.arl', 'c_empresa.nombre AS empresa', 'activos.activo', 'activos.codigo', 'vehiculos.identificador', 'vehiculos.foto_vehiculo', 'tipo.tipo', 'marca.marca', 'v_empresa.nombre AS empresavisitada', 'usuarios.name', 'usuarios.city')
    // }

    // protected $consulta;

    public function __construct($consulta, $registrosCompletos, $esColaborador, $esColOrVisi = false)
    {
        $this->consulta = $consulta;
        $this->registrosCompletos = $registrosCompletos;
        $this->esColaborador = $esColaborador;
        $this->esColOrVisi = $esColOrVisi;
    }

    public function view(): View
    {
        // $reporte = Registro::select('se_registros.*', 'personas.nombre', 'personas.apellido', 'personas.identificacion', 'personas.tel_contacto', 'personas.email', 'personas.id_tipo_persona', 'v_empresa.nombre AS empresavisitada', 'usuarios.name', 'usuarios.city')
        // ->leftjoin('se_personas AS personas', 'se_registros.id_persona', '=', 'personas.id_personas')
        // ->leftjoin('se_empresas AS v_empresa', 'se_registros.empresa_visitada', '=', 'v_empresa.id_empresas')
        // ->leftjoin('se_usuarios AS usuarios', 'se_registros.id_usuario', '=', 'usuarios.id_usuarios')
        // ->where('id_tipo_persona', '!=', 4)->where('empresa_visitada', 3)->where('city', 'Bogotá')->get();

        // return view('pages.reportes.plantillaExportaciones', [
        //     'reportes' => $reporte
        // ]);

        return view('pages.reportes.plantillaExportaciones', ['reportes' => $this->consulta, 'registrosCompletos' => $this->registrosCompletos, 'esColaborador' => $this->esColaborador, 'esColOrVisi' => $this->esColOrVisi]);
    }
}
