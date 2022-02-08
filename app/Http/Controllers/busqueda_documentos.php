<?php

namespace GeCo\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class busqueda_documentos extends Controller
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
        $medio_entregas = DB::table('medio_entregas')
                                ->select('medio_entregas.*')
                                ->orderby('medent_id')
                                ->get();
        $tipo_documentos = DB::table('tipo_documentos')
                                ->select('tipo_documentos.*')
                                ->orderby('tipdoc_id')
                                ->get();
        $empresas = DB::table('empresas')
                                ->select('empresas.*')
                                ->orderby('emp_id')
                                ->get(); 
        $tipo_remitentes = DB::table('tipo_remitentes')
                                ->select('tipo_remitentes.*')
                                ->orderby('tiprem_id')
                                ->get();                       

        return view('Recibida.busqueda_documentos', compact('medio_entregas','tipo_documentos','empresas','tipo_remitentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $codigo = $request->input('codigo');
        $fecha_d = $request->input('fecha_documento');
        $fecha_r = $request->input('fecha_recepcion');
        $nombre_d = $request->input('nombre_destinatario');
        $nombre_r = $request->input('nombre_remitente');
        $empresa_r = $request->input('empresa_remitente');
        $referencia = $request->input('referencia');
        $asunto =  $request->input('asunto');

        if ($request->input('medio_entrega')==0) {
            $condicion = "!=";
        }else{
            $condicion = "=";
        }

        if($request->input('fecha_documento')==null){
            $fecha_d = "1111-11-11";
            $condicion2 = "!=";
        }else{
            $condicion2 ="=";
        }

        if($request->input('fecha_recepcion')==null){
            $fecha_r = "1111-11-11";
            $condicion3 = "!=";
        }else{
            $condicion3 ="=";
        }

        if ($request->input('tipo_documento')==0) {
            $condicion4 = "!=";
        }else{
            $condicion4 = "=";
        }

        if($request->input('empresa_remitente')==0){
            $condicion5 = "!=";
        }else{
            $condicion5 = "=";
        }

        if($request->input('tipo_remitente')==0){
            $condicion6 = "!=";
        }else{
            $condicion6 = "=";
        }

        $c_recibida = DB::table('c_recibidas')
                ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                ->where("cr_codigo", "ilike", "%$codigo%")
                ->where("cr_medio_entrega", $condicion, $request->input('medio_entrega'))
                ->where("cr_fecha_documento", $condicion2, $fecha_d)
                ->where("cr_fecha_recepcion", $condicion3, $fecha_r)
                ->where("cr_tipo_documento", $condicion4, $request->input('tipo_documento'))
                ->where("cr_nombre_destinatario", "ilike", "%$nombre_d%")
                ->where("cr_empresa_remitente", $condicion5, $request->input('empresa_remitente'))
                ->where("cr_nombre_remitente", "ilike", "%$nombre_r%")
                ->where("cr_empresa_remitente", "ilike", "%$empresa_r%")
                ->where("cr_tipo_remitente", $condicion6, $request->input('tipo_remitente'))
                ->where("cr_referencia", "ilike", "%$referencia%")
                ->where("cr_asunto", "ilike", "%$asunto%")
                ->get();

        $medio_entregas = DB::table('medio_entregas')
                                ->select('medio_entregas.*')
                                ->orderby('medent_id')
                                ->get();
        $tipo_documentos = DB::table('tipo_documentos')
                                ->select('tipo_documentos.*')
                                ->orderby('tipdoc_id')
                                ->get();
        $empresas = DB::table('empresas')
                                ->select('empresas.*')
                                ->orderby('emp_id')
                                ->get(); 
        $tipo_remitentes = DB::table('tipo_remitentes')
                                ->select('tipo_remitentes.*')
                                ->orderby('tiprem_id')
                                ->get();            
        //return $c_recibida;
        return view('Recibida.listado_busqueda',compact('c_recibida','medio_entregas','tipo_documentos','empresas','tipo_remitentes'));
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
