<?php

namespace GeCo\Http\Controllers;

use Illuminate\Http\Request;
use GeCo\Models\acciones;
use DB;
class acciones_r extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Recibida.acciones');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $accion = new acciones();
        $accion->setKeyName('acc_id');
        $accion->acc_c_recibida = $request->input('codigo_c_recibida');  
        $accion->acc_fecha_accion = $request->input('fecha_accion');
        $accion->acc_tipo_accion = $request->input('tipo_accion');
        $accion->acc_observaciones = $request->input('observaciones');
        $accion->acc_empleado = auth()->user()->name;
        $accion->save();

        $c_recibida = DB::table('c_recibidas')
                        ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                        ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                        ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                        ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                        ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                        ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                        ->where("cr_id", "=", $accion->acc_c_recibida)
                        ->get();
        foreach ($c_recibida as $recibida) {
            $codigo = $recibida->cr_codigo;
        }
        $var = json_decode($c_recibida,true);
        $var2 = count($var);
        if ($var2==0) {
            return redirect()->route('Buscar_Documento_a.create')->with('status', "El Documento no existe!");
        }else{  
            $tipo_acciones = DB::table('tipo_acciones')
                                ->select('tipo_acciones.*')
                                ->orderby('tipacc_id')
                                ->get();
            foreach ($c_recibida as $recibida) {                    
                $acciones = DB::table('acciones')
                                    ->join('tipo_acciones', 'acciones.acc_tipo_accion', '=', 'tipo_acciones.tipacc_id')
                                    ->where("acc_c_recibida", "=", $recibida->cr_id)
                                    ->orderby('acc_id')
                                    ->get();
            }
            //return $acciones;
            return redirect()->route('Acciones.create', $codigo)->with('c_recibida',$c_recibida)->with('tipo_acciones',$tipo_acciones)->with('acciones',$acciones);
        }  
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
        $tipo_acciones = DB::table('tipo_acciones')
                        ->select('tipo_acciones.*')
                        ->orderby('tipacc_id')
                        ->get();
        $accion = DB::table('acciones')
                        ->join('tipo_acciones', 'acciones.acc_tipo_accion', '=', 'tipo_acciones.tipacc_id')
                        ->where("acc_id", "=", $id)
                        ->orderby('acc_id')
                        ->get();
        foreach ($accion as $acc) {
            $c_recibida = DB::table('c_recibidas')
                            ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                            ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                            ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                            ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                            ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                            ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                            ->where("cr_id", "=", $acc->acc_c_recibida)
                            ->get();

            $acciones = DB::table('acciones')
                                        ->join('tipo_acciones', 'acciones.acc_tipo_accion', '=', 'tipo_acciones.tipacc_id')
                                        ->where("acc_c_recibida", "=", $acc->acc_c_recibida)
                                        ->orderby('acc_id')
                                        ->get();
        }
        //return $acciones;
        return view('Recibida.actualizacion_acciones', compact('c_recibida','tipo_acciones','accion','acciones'));
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
        $accion = acciones::where('acc_id', '=', $id)->firstOrFail();
        $accion->setKeyName('acc_id');
        $accion->acc_c_recibida = $request->input('codigo_c_recibida');  
        $accion->acc_fecha_accion = $request->input('fecha_accion');
        $accion->acc_tipo_accion = $request->input('tipo_accion');
        $accion->acc_observaciones = $request->input('observaciones');
        $accion->acc_empleado = auth()->user()->name;
        $accion->save();

        $c_recibida = DB::table('c_recibidas')
                        ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                        ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                        ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                        ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                        ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                        ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                        ->where("cr_id", "=", $accion->acc_c_recibida)
                        ->get();
        foreach ($c_recibida as $recibida) {
            $codigo = $recibida->cr_codigo;
        }
        $var = json_decode($c_recibida,true);
        $var2 = count($var);
        if ($var2==0) {
            return redirect()->route('Buscar_Documento_a.create')->with('status', "El Documento no existe!");
        }else{  
            $tipo_acciones = DB::table('tipo_acciones')
                                ->select('tipo_acciones.*')
                                ->orderby('tipacc_id')
                                ->get();
            foreach ($c_recibida as $recibida) {                    
                $acciones = DB::table('acciones')
                                    ->join('tipo_acciones', 'acciones.acc_tipo_accion', '=', 'tipo_acciones.tipacc_id')
                                    ->where("acc_c_recibida", "=", $recibida->cr_id)
                                    ->orderby('acc_id')
                                    ->get();
            }
            //return $acciones;
            return redirect()->route('Acciones.create', $codigo)->with('c_recibida',$c_recibida)->with('tipo_acciones',$tipo_acciones)->with('acciones',$acciones);
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accion = acciones::where('acc_id', '=', $id)->firstOrFail();
        $c_recibida = DB::table('c_recibidas')
                        ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                        ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                        ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                        ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                        ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                        ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                        ->where("cr_id", "=", $accion->acc_c_recibida)
                        ->get();
        foreach ($c_recibida as $recibida) {
            $codigo = $recibida->cr_codigo;
        }
        $accion->setKeyName('acc_id');
        $accion->delete();
        $var = json_decode($c_recibida,true);
        $var2 = count($var);
        if ($var2==0) {
            return redirect()->route('Buscar_Documento_a.create')->with('status', "El Documento no existe!");
        }else{  
            $tipo_acciones = DB::table('tipo_acciones')
                                ->select('tipo_acciones.*')
                                ->orderby('tipacc_id')
                                ->get();
            foreach ($c_recibida as $recibida) {                    
                $acciones = DB::table('acciones')
                                    ->join('tipo_acciones', 'acciones.acc_tipo_accion', '=', 'tipo_acciones.tipacc_id')
                                    ->where("acc_c_recibida", "=", $recibida->cr_id)
                                    ->orderby('acc_id')
                                    ->get();
            }
            //return $acciones;
            return redirect()->route('Acciones.create', $codigo)->with('c_recibida',$c_recibida)->with('tipo_acciones',$tipo_acciones)->with('acciones',$acciones);
        }  
    }
}
