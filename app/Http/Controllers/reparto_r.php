<?php

namespace GeCo\Http\Controllers;

use Illuminate\Http\Request;
use GeCo\Models\reparto;
use DB;

class reparto_r extends Controller
{
    //public $var = 'carechimbo'; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Recibida.buscar_documento');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Recibida.reparto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reparto = new reparto();
        $reparto->setKeyName('rep_id');
        $reparto->rep_c_recibida = $request->input('codigo_c_recibida');
        $reparto->rep_fecha_reparto = $request->input('fecha_reparto');
        $reparto->rep_medio_reparto = $request->input('medio_entrega');
        $reparto->rep_empleado_reparto = $request->input('enviado_a');
        $reparto->rep_empleado = auth()->user()->name;
        $reparto->save();
        $c_recibida = DB::table('c_recibidas')
                        ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                        ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                        ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                        ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                        ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                        ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                        ->where("cr_id", "=", $reparto->rep_c_recibida)
                        ->get();
        foreach ($c_recibida as $recibida) {
            $codigo = $recibida->cr_codigo;
        }

        $var = json_decode($c_recibida,true);
        $var2 = count($var);
        if ($var2==0) {
            return redirect()->route('Buscar_Documento.create')->with('status', "El Documento no existe!");
        }else{  
            $usuarios = DB::table('users')
                                ->select('users.id','users.name')
                                ->orderby('id')
                                ->get();
            $medio_entregas = DB::table('medio_entregas')
                                ->select('medio_entregas.*')
                                ->orderby('medent_id')
                                ->get();
            foreach ($c_recibida as $recibida) {                    
                $repartos = DB::table('repartos')
                                    ->join('users', 'repartos.rep_empleado_reparto', '=', 'users.id')
                                    ->join('medio_entregas', 'repartos.rep_medio_reparto', '=', 'medio_entregas.medent_id')
                                    ->select('repartos.*', 'users.name', 'medio_entregas.medent_nombre')
                                    ->where("rep_c_recibida", "=", $recibida->cr_id)
                                    ->orderby('rep_id')
                                    ->get();
            }

        return redirect()->route('Reparto.create', $codigo)->with('c_recibida',$c_recibida)->with('usuarios',$usuarios)->with('medio_entregas',$medio_entregas)->with('repartos',$repartos);
        
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
        $medio_entregas = DB::table('medio_entregas')
                                ->select('medio_entregas.*')
                                ->orderby('medent_id')
                                ->get();
        $usuarios = DB::table('users')
                                ->select('users.id','users.name')
                                ->orderby('id')
                                ->get();
        $reparto = DB::table('repartos')
                                    ->join('users', 'repartos.rep_empleado_reparto', '=', 'users.id')
                                    ->join('medio_entregas', 'repartos.rep_medio_reparto', '=', 'medio_entregas.medent_id')
                                    ->select('repartos.*', 'users.name', 'medio_entregas.medent_nombre')
                                    ->where("rep_id", "=", $id)
                                    ->orderby('rep_id')
                                    ->get();
        foreach ($reparto as $rep) {
            $c_recibida = DB::table('c_recibidas')
                            ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                            ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                            ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                            ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                            ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                            ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                            ->where("cr_id", "=", $rep->rep_c_recibida)
                            ->get();                
            $repartos = DB::table('repartos')
                            ->join('users', 'repartos.rep_empleado_reparto', '=', 'users.id')
                            ->join('medio_entregas', 'repartos.rep_medio_reparto', '=', 'medio_entregas.medent_id')
                            ->select('repartos.*', 'users.name', 'medio_entregas.medent_nombre')
                            ->where("rep_c_recibida", "=", $rep->rep_c_recibida)
                            ->orderby('rep_id')
                            ->get();

        }
        //return $reparto;
        return view('Recibida.actualizacion_reparto', compact('c_recibida','medio_entregas','usuarios','reparto','repartos'));
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
        $reparto = reparto::where('rep_id', '=', $id)->firstOrFail();
        $reparto->setKeyName('rep_id');
        $reparto->rep_c_recibida = $request->input('codigo_c_recibida');
        $reparto->rep_fecha_reparto = $request->input('fecha_reparto');
        $reparto->rep_medio_reparto = $request->input('medio_entrega');
        $reparto->rep_empleado_reparto = $request->input('enviado_a');
        $reparto->rep_empleado = auth()->user()->name;
        $reparto->save();

        $c_recibida = DB::table('c_recibidas')
                        ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                        ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                        ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                        ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                        ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                        ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                        ->where("cr_id", "=", $reparto->rep_c_recibida)
                        ->get();
        foreach ($c_recibida as $recibida) {
            $codigo = $recibida->cr_codigo;
        }

        $var = json_decode($c_recibida,true);
        $var2 = count($var);
        if ($var2==0) {
            return redirect()->route('Buscar_Documento.create')->with('status', "El Documento no existe!");
        }else{  
            $usuarios = DB::table('users')
                                ->select('users.id','users.name')
                                ->orderby('id')
                                ->get();
            $medio_entregas = DB::table('medio_entregas')
                                ->select('medio_entregas.*')
                                ->orderby('medent_id')
                                ->get();
            foreach ($c_recibida as $recibida) {                    
                $repartos = DB::table('repartos')
                                    ->join('users', 'repartos.rep_empleado_reparto', '=', 'users.id')
                                    ->join('medio_entregas', 'repartos.rep_medio_reparto', '=', 'medio_entregas.medent_id')
                                    ->select('repartos.*', 'users.name', 'medio_entregas.medent_nombre')
                                    ->where("rep_c_recibida", "=", $recibida->cr_id)
                                    ->orderby('rep_id')
                                    ->get();
            }

        return redirect()->route('Reparto.create', $codigo)->with('c_recibida',$c_recibida)->with('usuarios',$usuarios)->with('medio_entregas',$medio_entregas)->with('repartos',$repartos);
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
        $reparto = reparto::where('rep_id', '=', $id)->firstOrFail();
        $c_recibida = DB::table('c_recibidas')
                        ->join('empresas', 'c_recibidas.cr_empresa_destinatario', '=', 'empresas.emp_id')
                        ->join('estado_documentos', 'c_recibidas.cr_estado_documento', '=', 'estado_documentos.estdoc_id')
                        ->join('medio_entregas', 'c_recibidas.cr_medio_entrega', '=', 'medio_entregas.medent_id')
                        ->join('tipo_documentos', 'c_recibidas.cr_tipo_documento', '=', 'tipo_documentos.tipdoc_id')
                        ->join('tipo_remitentes', 'c_recibidas.cr_tipo_remitente', '=', 'tipo_remitentes.tiprem_id')
                        ->select('c_recibidas.*', 'empresas.emp_nombre', 'estado_documentos.estdoc_nombre', 'medio_entregas.medent_nombre', 'tipo_documentos.tipdoc_nombre', 'tipo_remitentes.tiprem_nombre')
                        ->where("cr_id", "=", $reparto->rep_c_recibida)
                        ->get();
        foreach ($c_recibida as $recibida) {
            $codigo = $recibida->cr_codigo;
        }
        $reparto->setKeyName('rep_id');
        $reparto->delete();
        $var = json_decode($c_recibida,true);
        $var2 = count($var);
        if ($var2==0) {
            return redirect()->route('Buscar_Documento.create')->with('status', "El Documento no existe!");
        }else{  
            $usuarios = DB::table('users')
                                ->select('users.id','users.name')
                                ->orderby('id')
                                ->get();
            $medio_entregas = DB::table('medio_entregas')
                                ->select('medio_entregas.*')
                                ->orderby('medent_id')
                                ->get();
            foreach ($c_recibida as $recibida) {                    
                $repartos = DB::table('repartos')
                                    ->join('users', 'repartos.rep_empleado_reparto', '=', 'users.id')
                                    ->join('medio_entregas', 'repartos.rep_medio_reparto', '=', 'medio_entregas.medent_id')
                                    ->select('repartos.*', 'users.name', 'medio_entregas.medent_nombre')
                                    ->where("rep_c_recibida", "=", $recibida->cr_id)
                                    ->orderby('rep_id')
                                    ->get();
            }
        return redirect()->route('Reparto.create', $codigo)->with('c_recibida',$c_recibida)->with('usuarios',$usuarios)->with('medio_entregas',$medio_entregas)->with('repartos',$repartos);
        
    }
}
}
