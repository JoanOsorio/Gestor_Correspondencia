<?php

namespace GeCo\Http\Controllers;

use GeCo\Models\c_enviada;
use Illuminate\Http\Request;
use DB;

class nuevo_documento_e extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c_enviadas = DB::table('c_enviadas')
                        ->join('empresas', 'c_enviadas.ce_empresa_remitente', '=', 'empresas.emp_id')
                        ->join('estado_documentos', 'c_enviadas.ce_estado_documento', '=', 'estado_documentos.estdoc_id')
                        ->join('estado_entregas', 'c_enviadas.ce_estado_entrega', '=', 'estado_entregas.estent_id')
                        ->join('estado_seguimientos', 'c_enviadas.ce_estado_seguimiento', '=', 'estado_seguimientos.estseg_id')
                        ->join('forma_entregas', 'c_enviadas.ce_forma_entrega', '=', 'forma_entregas.forent_id')
                        ->select('c_enviadas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'estado_entregas.estent_nombre', 'estado_seguimientos.estseg_nombre', 'forma_entregas.forent_nombre')
                        ->get();
        return view('Enviada.listado_documentos', compact('c_enviadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $c_enviadas = DB::table('empresas')->get();
        $c_enviadas2 = DB::table('forma_entregas')->get();
        $c_enviadas3 = DB::table('estado_seguimientos')->get();  
        $nombre_r = "CE-".date("Y-m-d-").date("His");                      
        return view('Enviada.nuevo_documento', compact('c_enviadas','c_enviadas2','c_enviadas3','nombre_r'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enviada = new c_enviada();
        //Cambiar el nombre de la pk ->defecto 'id'
        $enviada->setKeyName('ce_id');
        $enviada->ce_codigo = $request->input('codigo');
        $enviada->ce_fecha_creacion_documento = $request->input('fecha_documento');
        $enviada->ce_empresa_remitente = $request->input('empresa_remitente');
        $enviada->ce_firma_responsable = $request->input('firma_responsable');
        $enviada->ce_nombre_destinatario = $request->input('nombre_destinatario');
        $enviada->ce_empresa_destinatario = $request->input('empresa_destinatario');
        $enviada->ce_asunto = $request->input('asunto');
        $enviada->ce_estado_seguimiento = $request->input('seguimiento');
        $enviada->ce_respuesta_a = $request->input('respuesta_a');
        $enviada->ce_observaciones = $request->input('observaciones');
        $enviada->ce_forma_entrega = $request->input('forma_entrega');
        $enviada->ce_estado_entrega = 3;
        $enviada->ce_estado_documento = 1;
        if ($request->hasFile('documento')) {
            $file = $request->file('documento');
            $name = date("Y-m-d")."-".date("His")."-".$file->getClientOriginalName();
            $file->move(public_path().'/documentos/enviados/', $name);
            $enviada->ce_documento = $name;
        }
        $enviada->ce_empleado = auth()->user()->name;
        $enviada->slug = "doc-".($request->input('codigo'));  
        $enviada->save(); 
        return redirect()->route('Enviada.index', [$enviada->slug])->with('status',"El Documento ".$enviada->ce_codigo.' fue creado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $c_enviada = c_enviada::where('slug', '=', $slug)->firstOrFail();
        $empresas = DB::table('empresas')
                        ->select('empresas.*')
                        ->where("emp_id", "=", $c_enviada->ce_empresa_remitente)
                        ->get();
        $forma_entregas = DB::table('forma_entregas')
                        ->select('forma_entregas.*')
                        ->where("forent_id", "=", $c_enviada->ce_forma_entrega)
                        ->get();
        $estado_entregas = DB::table('estado_entregas')
                        ->select('estado_entregas.*')
                        ->where("estent_id", "=", $c_enviada->ce_estado_entrega)
                        ->get();
        $estado_documentos = DB::table('estado_documentos')
                        ->select('estado_documentos.*')
                        ->where("estdoc_id", "=", $c_enviada->ce_estado_documento)
                        ->get();                                
        return view('Enviada.documento', compact('c_enviada','empresas','forma_entregas','estado_documentos','estado_entregas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $c_enviadas2 = DB::table('empresas')->orderby('emp_id')->get();
        $c_enviadas3 = DB::table('forma_entregas')->orderby('forent_id')->get();
        $c_enviadas4 = DB::table('estado_entregas')->orderby('estent_id')->get();
        $c_enviada = c_enviada::where('slug', '=', $slug)->firstOrFail();
        return view('Enviada.actualizacion_documento', compact('c_enviada','c_enviadas2','c_enviadas3','c_enviadas4'));
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
        $enviada = c_enviada::where('slug', '=', $slug)->firstOrFail();
        $enviada->setKeyName('ce_id');
        $enviada->ce_codigo = $request->input('codigo');
        $enviada->ce_fecha_creacion_documento = $request->input('fecha_documento');
        $enviada->ce_empresa_remitente = $request->input('empresa_remitente');
        $enviada->ce_firma_responsable = $request->input('firma_responsable');
        $enviada->ce_nombre_destinatario = $request->input('nombre_destinatario');
        $enviada->ce_empresa_destinatario = $request->input('empresa_destinatario');
        $enviada->ce_asunto = $request->input('asunto');
        $enviada->ce_estado_seguimiento = $request->input('seguimiento');
        $enviada->ce_respuesta_a = $request->input('respuesta_a');
        $enviada->ce_observaciones = $request->input('observaciones');
        $enviada->ce_forma_entrega = $request->input('forma_entrega');
        $enviada->ce_estado_entrega = $request->input('estado_entrega');
        $enviada->ce_fecha_entrega = $request->input('fecha_entrega');
        $enviada->ce_hora_entrega = $request->input('hora_entrega');
        //$enviada->ce_estado_documento = 1;
        if ($request->hasFile('documento')) {
            //Para eliminar el archivo viejo ya que se actualiza por el nuevo
            //Valida si existe ese archivo
            if($enviada->ce_documento != null){
                unlink(public_path().'/documentos/enviados/'.$enviada->ce_documento);
            }
            $file = $request->file('documento');
            $name = date("Y-m-d")."-".date("His")."-".$file->getClientOriginalName();
            $file->move(public_path().'/documentos/enviados/', $name);
            $enviada->ce_documento = $name;
        }
        $enviada->save();
        return redirect()->route('Enviada.show', [$enviada->slug])->with('status','El Documento  fue actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $enviada = c_enviada::where('slug', '=', $slug)->firstOrFail();
        $enviada->setKeyName('ce_id');
        if($enviada->ce_documento != null){
            unlink(public_path().'/documentos/enviados/'.$enviada->ce_documento);
        }
        $enviada->delete();
        return redirect()->route('Enviada.index', [$enviada->slug])->with('status',"El Documento ".$enviada->ce_codigo.' fue eliminado Correctamente');
    }

}
