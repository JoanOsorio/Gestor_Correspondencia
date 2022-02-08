@extends('layouts.menu')

@section('title','Busqueda de Documentos')

@section('estilos')
	.marcoTablePro {
        width: 100%;
        border-style: solid;
        border-radius: 5px;
        border-width: 1px;
        border-color: #e9e9e9;
        height: 460px;
        font-size: 13px;
        padding: 10px;
    }
    .table-pro {
        margin-bottom: 10px;
        white-space: nowrap;
        background-color: #e9e9e9;
    }
    .titulo{
        text-align:center;
        margin:20px;
    }
    thead{
        background-color: #204051;
    }
    .marcoTablePro thead tr td{
        color:#ffffff;
    }
    .table-condensed > tbody > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > thead > tr > th {
    padding: 6px;
    }

@endsection

@section('content')
    <br>
    <div class="titulo ">
        <h2>Listado de Documentos Enviados</h2>
        <center><p>Muestra el listado de los documentos enviados y permite filtrar por los campos de la tabla</p></center>
    </div>
    <br>
    <div class="card">
    	<div class="marcoTablePro">
            <table class="table table-bordered table-condensed table-pro" id="d_enviados">
                <thead>
                    <tr>
                        <td> Edicion </td>
                        <td> Codigo </td>
                        <td> Fecha Creacion Documento </td>
                        <td> Empresa Remitente </td>
                        <td> Nombre Destinatario </td>
                        <td> Asunto </td>
                        <td> Estado Seguimiento </td>
                        <td> Estado Documento </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($c_enviadas as $c_enviada)
                    <tr>
                        <td><center>
                            <a href="/Enviada/{{$c_enviada->slug}}/edit"><i class="fa fa-pencil-square"></i></a></td>
                        </center>
                        <td>
                            <center>
                                <a  href="/Enviada/{{$c_enviada->slug}}">{{$c_enviada->ce_codigo}}</a>
                            </center>
                        </td>
                        <td> {{$c_enviada->ce_fecha_creacion_documento}} </td>
                        <td> {{$c_enviada->emp_nombre}} </td>
                        <td> {{$c_enviada->ce_nombre_destinatario}} </td>
                        <td> {{$c_enviada->ce_asunto}} </td>
                        <td> {{$c_enviada->estseg_nombre}} </td>
                        <td> {{$c_enviada->estdoc_nombre}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection

@section('funcionesjs')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
@endsection
