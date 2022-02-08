<?php

namespace GeCo\Http\Controllers;

use GeCo\Models\c_recibida;
use Illuminate\Http\Request;
use DB;

class seguimiento_r extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Recibida.buscar_documento_s');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Recibida.busqueda_documentos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $c_recibida = DB::table('c_recibidas')
                        ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                        ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                        ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                        ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                        ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                        ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                        ->where("cr_codigo", "=", $request->input('codigo'))
                        ->get();
        $var = json_decode($c_recibida,true);
        $var2 = count($var);
        if ($var2==0) {
            return redirect()->route('Seguimiento.index')->with('status', "El Documento no existe!");
        }else{  
             foreach ($c_recibida as $rec) {
                $repartos = DB::table('repartos')
                            ->join('users', 'repartos.rep_empleado_reparto', '=', 'users.id')
                            ->join('medio_entregas', 'repartos.rep_medio_reparto', '=', 'medio_entregas.medent_id')
                            ->select('repartos.*', 'users.name', 'medio_entregas.medent_nombre')
                            ->where("rep_c_recibida", "=", $rec->cr_id)
                            ->orderby('rep_id')
                            ->get();
                $acciones = DB::table('acciones')
                            ->join('tipo_acciones', 'acciones.acc_tipo_accion', '=', 'tipo_acciones.tipacc_id')
                            ->where("acc_c_recibida", "=", $rec->cr_id)
                            ->orderby('acc_id')
                            ->get();           
            }

        }                
        
        return view('Recibida.seguimiento', compact('c_recibida','repartos','acciones'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
