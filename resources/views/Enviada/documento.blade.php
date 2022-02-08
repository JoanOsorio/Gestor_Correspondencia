@extends('layouts.menu')

@section('title','Documento Enviado')

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
        <iframe src="/documentos/enviados/{{$c_enviada->ce_documento}}" frameborder="0"></iframe>
    </div>
    <div class="float-left" style="width: 36%; height: 100%; padding: 30px;" >
        <center>
            <h2>Datos del Documento</h2>
            <p>Muestra la visualizacion previa del documento enviado con su respectiva informacion</p>
        </center>
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @else
            <br>
        @endif
        <label><b>Codigo Documento:</b></label>
        <label>{{$c_enviada->ce_codigo}}</label>
        <br>
        <label><b>Fecha del Documento:</b></label>
        <label>{{$c_enviada->ce_fecha_creacion_documento}}</label>
        <br>
        <label><b>Empresa Remitente:</b></label>
        @foreach($empresas as $empresa)
            <label>{{$empresa->emp_nombre}}</label>
        @endforeach
        <br>
        <label><b>Codigo Documento:</b></label>
        <label>{{$c_enviada->ce_firma_responsable}}</label>
        <br>
        <label><b>Nombre del Destinatario:</b></label>
        <label>{{$c_enviada->ce_nombre_destinatario}}</label>
        <br>
        <label><b>Empresa Destinatario:</b></label>
        <label>{{$c_enviada->ce_empresa_destinatario}}</label>
        <br>
        <label><b>Asunto:</b></label>
        <label>{{$c_enviada->ce_asunto}}</label>
        <br>
        <label><b>Respuesta a:</b></label>
        <label>{{$c_enviada->ce_respuesta_a}}</label>
        <br>
        <label><b>Observaciones</b></label>
        <label>{{$c_enviada->ce_observaciones}}</label>
        <br>
        <label><b>Forma de Entrega:</b></label>
        @foreach($forma_entregas as $forma_entrega)
            <label>{{$forma_entrega->forent_nombre}}</label>
        @endforeach
        <br>
        <label><b>Estado de la Entrega:</b></label>
        @foreach($estado_entregas as $estado_entrega)
            <label>{{$estado_entrega->estent_nombre}}</label>
        @endforeach
        <br>
        <label><b>Fecha de Entrega:</b></label>
        <label>{{$c_enviada->ce_fecha_entrega}}</label>
        <br>
        <label><b>Hora de Entrega:</b></label>
        <label>{{$c_enviada->ce_hora_entrega}}</label>
        <br>
        <label><b>Estado del Dcumento:</b></label>
        @foreach($estado_documentos as $estado_documento)
            <label>{{$estado_documento->estdoc_nombre}}</label>
        @endforeach
        <br>
        <label><b>Empleado que registro el Documento:</b></label>
        <label>{{$c_enviada->ce_empleado}}</label>
        <br><br>
        <center>
            <a class="btn btn-warning" href="/Enviada/">Atras</a>
            <a class="btn btn-success" href="/Enviada/{{$c_enviada->slug}}/edit">Editar</a>
        </center> 
    </div>
</div>
@endsection
