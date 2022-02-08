<?php

namespace GeCo\Http\Controllers;

use GeCo\Models\c_recibida;
use Illuminate\Http\Request;
use DB;

class nuevo_documento_r extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c_recibidas = DB::table('c_recibidas')
                ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                ->select('c_recibidas.*', 'estado_documentos.estdoc_nombre')
                ->get();
        return view('Recibida.listado_documentos', compact('c_recibidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Cambiar definiciones de las variables con order by tambien
        $c_recibida1 = DB::table('empresas')->get();
        $c_recibida2 = DB::table('medio_entregas')->get();
        $c_recibida3 = DB::table('tipo_documentos')->get();
        $c_recibida4 = DB::table('tipo_remitentes')->get();  
        $nombre_r = "CR-".date("Y-m-d-").date("His");               
        return view('Recibida.nuevo_documento', compact('c_recibida1','c_recibida2','c_recibida3','c_recibida4','nombre_r'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
s     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recibida = new c_recibida();
        $recibida->setKeyName('cr_id');
        $recibida->cr_codigo = $request->input('codigo_r');
        $recibida->cr_medio_entrega = $request->input('medio_entrega');
        $recibida->cr_fecha_documento = $request->input('fecha_documento');
        $recibida->cr_fecha_recepcion  = $request->input('fecha_recepcion');
        $recibida->cr_tipo_documento = $request->input('tipo_documento');
        $recibida->cr_nombre_destinatario = $request->input('nombre_destinatario');
        $recibida->cr_empresa_destinatario = $request->input('empresa_destinatario');       
        $recibida->cr_nombre_remitente = $request->input('nombre_remitente');
        $recibida->cr_empresa_remitente = $request->input('empresa_remitente');       
        $recibida->cr_tipo_remitente = $request->input('tipo_remitente');   
        $recibida->cr_referencia = $request->input('referencia');
        $recibida->cr_asunto = $request->input('asunto');
        $recibida->cr_estado_documento = 1;
        if ($request->hasFile('documento')) {
            $file = $request->file('documento');
            $name = date("Y-m-d")."-".date("His")."-".$file->getClientOriginalName();
            $file->move(public_path().'/documentos/recibidos/', $name);
            $recibida->cr_documento = $name;
        }
        $recibida->cr_empleado = 'Joan';
        $recibida->slug = "doc-".($request->input('codigo_r'));
        $recibida->save();

        return redirect()->route('Recibida.index', [$recibida->slug])->with('status',"El Documento ".$recibida->cr_codigo.' fue creado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $c_recibida = c_recibida::where('slug', '=', $slug)->firstOrFail();
        $medio_entregas = DB::table('medio_entregas')
                        ->select('medio_entregas.*')
                        ->where("medent_id", "=", $c_recibida->cr_medio_entrega)
                        ->get();
        $tipo_documentos = DB::table('tipo_documentos')
                        ->select('tipo_documentos.*')
                        ->where("tipdoc_id", "=", $c_recibida->cr_tipo_documento)
                        ->get();
        $empresas = DB::table('empresas')
                        ->select('empresas.*')
                        ->where("emp_id", "=", $c_recibida->cr_empresa_destinatario)
                        ->get();
        $tipo_remitentes = DB::table('tipo_remitentes')
                        ->select('tipo_remitentes.*')
                        ->where("tiprem_id", "=", $c_recibida->cr_tipo_remitente)
                        ->get();
        $estado_documentos = DB::table('estado_documentos')
                        ->select('estado_documentos.*')
                        ->where("estdoc_id", "=", $c_recibida->cr_estado_documento)
                        ->get();                                
        //return $c_recibida;
        return view('Recibida.documento', compact('c_recibida','medio_entregas','tipo_documentos','empresas','tipo_remitentes','estado_documentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $empresas = DB::table('empresas')->orderby('emp_id')->get();
        $medio_entregas = DB::table('medio_entregas')->orderby('medent_id')->get();
        $tipo_documentos = DB::table('tipo_documentos')->orderby("tipdoc_id")->get();
        $tipo_remitentes = DB::table('tipo_remitentes')->orderby('tiprem_id')->get();
        $c_recibida = c_recibida::where('slug', '=', $slug)->firstOrFail();
        //return $tipo_documentos;
        return view('Recibida.actualizacion_documento', compact('c_recibida','empresas','medio_entregas','tipo_documentos','tipo_remitentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $recibida = c_recibida::where('slug', '=', $slug)->firstOrFail();
        $recibida->setKeyName('cr_id');
        $recibida->cr_codigo = $request->input('codigo');
        $recibida->cr_medio_entrega = $request->input('medio_entrega');
        $recibida->cr_fecha_documento = $request->input('fecha_documento');
        $recibida->cr_fecha_recepcion  = $request->input('fecha_recepcion');
        $recibida->cr_tipo_documento = $request->input('tipo_documento');
        $recibida->cr_nombre_destinatario = $request->input('nombre_destinatario');
        $recibida->cr_empresa_destinatario = $request->input('empresa_destinatario');       
        $recibida->cr_nombre_remitente = $request->input('nombre_remitente');
        $recibida->cr_empresa_remitente = $request->input('empresa_remitente');       
        $recibida->cr_tipo_remitente = $request->input('tipo_remitente');   
        $recibida->cr_referencia = $request->input('referencia');
        $recibida->cr_asunto = $request->input('asunto');
        if ($request->hasFile('documento')) {
            //Para eliminar el archivo viejo ya que se actualiza por el nuevo
            //Valida si existe ese archivo
            if($recibida->cr_documento != null){
                unlink(public_path().'/documentos/recibidos/'.$recibida->cr_documento);
            }
            $file = $request->file('documento');
            $name = date("Y-m-d")."-".date("His")."-".$file->getClientOriginalName();
            $file->move(public_path().'/documentos/recibidos/', $name);
            $recibida->cr_documento = $name;
        }
        $recibida->cr_empleado = 'Joan';
        $recibida->save();

        return redirect()->route('Recibida.show', [$recibida->slug])->with('status', "El Documento fue atualizado Correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $recibida = c_recibida::where('slug', '=', $slug)->firstOrFail();
        $recibida->setKeyName('cr_id');
        if($recibida->cr_documento != null){
            unlink(public_path().'/documentos/recibidos/'.$recibida->cr_documento);
        }
        $recibida->delete();
        return redirect()->route('Recibida.index', [$recibida->slug])->with('status',"El Documento ".$recibida->cr_codigo.' fue eliminado Correctamente');
    }
}
