@extends('layouts.menu')

@section('title','Documento Recibido')

@section('estilos')
    <style type="text/css">
        iframe{
            width: 100%;
            height: 100%;
        }
        label{
            font-size: 14px;
        }   
    </style>
@endsection

@section('content')
    <div style="width: 100%; height:100%;" class="container">
        <div class="float-left" style="width: 64%; height: 98%">
            <iframe src="/documentos/recibidos/{{$c_recibida->cr_documento}}" frameborder="0"></iframe>
        </div>
        <div class="float-left" style="width: 36%; height: 100%; padding: 30px;" >
            <center>
                <h2>Datos del Documento</h3>
                <p>Muestra la visualizacion previa del documento recibido con su respectiva informacion</p>
            </center>
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @else
                <br>
            @endif
            <label><b>Codigo Documento: </b></label>
            <label>{{$c_recibida->cr_codigo}}</label>
            <br>
            <label><b>Medio de Entrega: </b></label>
            @foreach($medio_entregas as $entrega)
                <label>{{$entrega->medent_nombre}}</label>
            @endforeach
            <br>
            <label><b>Fecha del Documento: </b></label>
            <label>{{$c_recibida->cr_fecha_documento}}</label>
            <br>
            <label><b>Fecha de Recepcion del Documento: </b></label>
            <label>{{$c_recibida->cr_fecha_recepcion}}</label>
            <br>
            <label><b>Tipo de Documento: </b></label>
            @foreach($tipo_documentos as $documento)
                <label>{{$documento->tipdoc_nombre}}</label>
            @endforeach
            <br>
            <label><b>Nombre del Destinatario: </b></label>
            <label>{{$c_recibida->cr_nombre_destinatario}}</label>
            <br>
            <label><b>Empresa Destinatario: </b></label>
            @foreach($empresas as $empresa)
                <label>{{$empresa->emp_nombre}}</label>
            @endforeach
            <br>
            <label><b>Nombre del Remitente: </b></label>
            <label>{{$c_recibida->cr_nombre_remitente}}</label>
            <br>
            <label><b>Empresa Remitente: </b></label>
            <label>{{$c_recibida->cr_empresa_remitente}}</label>
            <br>
            <label><b>Tipo de Remitente: </b></label>
            @foreach($tipo_remitentes as $remitente)
                <label>{{$remitente->tiprem_nombre}}</label>
            @endforeach
            <br>
            <label><b>Referencia o Codigo: </b></label>
            <label>{{$c_recibida->cr_referencia}}</label>
            <br>
            <label><b>Asunto:</b></label>
            <label>{{$c_recibida->cr_asunto}}</label>
            <br>
            <label><b>Estado del Dcumento: </b></label>
            @foreach($estado_documentos as $estado_documento)
                <label>{{$estado_documento->estdoc_nombre}}</label>
            @endforeach
            <br>
            <label><b>Empleado que registro el Documento: </b></label>
            <label>{{$c_recibida->cr_empleado}}</label>
            <br><br>
            <center>
                <a class="btn btn-warning" href="/Recibida/">Atras</a>
                <a class="btn btn-success" href="/Recibida/{{$c_recibida->slug}}/edit">Editar</a>
            </center> 
        </div>
    </div>
@endsection