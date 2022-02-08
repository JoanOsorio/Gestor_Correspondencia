@extends('layouts.menu')

@section('title','Busqueda de Documentos Recibidos')

@section('estilos')
    <style type="text/css">
    	.marcoTablePro {
            width: 100%;
            border-style: solid;
            border-radius: 5px;
            border-width: 1px;
            border-color: transparent;
            height: 350px;
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
        .botom{
            margin: 0px;
            padding: 5px;
        }
        .botom2{
            margin: 0px;
            padding: 1px;
            font-size: 13px;
            width: 20px;
        }
        .document{
            height: 370px;
            width: 98%;
            background:#bfc9ca;
            border-radius:15px;
            margin-top:3px;
            margin: 10px;
            padding: 10px;
            margin-bottom: 0px;
        }
        .a{
            overflow: auto; 
        }
        .form{
            margin:6px;
            width:150px;
            font-size:15px;
            text-align:center;
        }
    </style>

@endsection

@section('content')
    <br>
    <div class="titulo ">
        <h2>Busqueda Azanzada de Documentos Recibidos</h2>
    </div>
    <div style="margin-left: 41px;">
    <form class="form-group" method="POST" action="/Busqueda_Documentos">
        @csrf
        <div class="form float-left">
            <input placeholder="Codigo" type="text" class="form-control" name="codigo">
        </div>
        <div class="form float-left">
            <select class="form-control" name="medio_entrega">
                <option value=0 selected="" class="form-control">--Medio de Entrega--</option>
                @foreach($medio_entregas as $medio)
                    <option class="form-control" value={{$medio->medent_id}}>{{$medio->medent_nombre}}</option>
                @endforeach 
            </select>
        </div> 
        <div class="form float-left">
            <input placeholder="Fecha Doc. " type="text" class="form-control" name="fecha_documento">
        </div>  
        <div class="form float-left">
            <input placeholder="Fecha Recep. aaaa/mm/dd" type="text" class="form-control" name="fecha_recepcion">
        </div> 
        <div class="form float-left">
            <select class="form-control" name="tipo_documento">
                <option value=0 selected="" class="form-control">--Tipo de Documento--</option>
                @foreach($tipo_documentos as $tipo)
                        <option class="form-control" value={{$tipo->tipdoc_id}}>{{$tipo->tipdoc_nombre}}</option>
                @endforeach 
            </select>
        </div> 
        <div class="form float-left">
            <input placeholder="Nombre Destinatario" type="text" class="form-control" name="nombre_destinatario">
        </div>
         <div class="form float-left">
            <select class="form-control" name="empresa_destinatario">
                <option value=0 selected="" class="form-control">--Empresa Destin.--</option>
                @foreach($empresas as $empresa)
                        <option class="form-control" value={{$empresa->emp_id}}>{{$empresa->emp_nombre}}</option>
                @endforeach   
            </select>
        </div> 
        <div class="form float-left">
            <input placeholder="Nombre Remitente" type="text" class="form-control" name="nombre_remitente">
        </div>
        <div class="form float-left">
            <input placeholder="Empresa Remitente" type="text" class="form-control" name="empresa_remitente">
        </div>
        <div class="form float-left">
            <select class="form-control" name="tipo_remitente">
                <option value=0 selected="" class="form-control">--Tipo Remitente.--</option>
                @foreach($tipo_remitentes as $tipo)
                    <option class="form-control" value={{$tipo->tiprem_id}}>{{$tipo->tiprem_nombre}}</option>
                @endforeach   
            </select>
        </div>      
        <div class="form float-left">
            <input placeholder="Radicado o Referencia" type="text" class="form-control" name="referencia">
        </div>
        <div class="form float-left">
            <input placeholder="Asunto" type="text" class="form-control" name="asunto">
        </div>        

    @if(session('status'))
        <div class="float-left">
            <a href="/Recibida/create" class="btn btn-success">Crear</a>
        </div>  
        <div class="alert alert-success" style="margin-left: 80px; margin-bottom: 0px;">
            {{session('status')}}
        </div>
    @else
        <div class="float-left" style="margin-left: 400px; margin-top: 10px; margin-bottom: 10px;">
            <button style="color: black;" class="btn btn-success" type="submit">Buscar</button>
            <a href="/Busqueda_Documentos/create" class="btn btn-warning">Limpiar</a>
        </div>
    @endif 
 
    </form>
    </div>
    <div class="document float-left">
    	<div class="marcoTablePro a">
            <table class="table table-bordered table-condensed table-pro">
                <thead>
                    <tr>
                        <td> Documento </td>
                        <td> Codigo </td>
                        <td> Medio Entrega </td>
                        <td> Fecha Documento </td>
                        <td> Fecha Recepcion </td>
                        <td> Tipo de Documento </td>
                        <td> Nombre Destinatario </td>
                        <td> Empresa Destinatario </td>
                        <td> Nombre Remitente </td>
                        <td> Empresa Remitente </td>
                        <td> Tipo Remitente </td>
                        <td> Referencia o Codigo </td>
                        <td> Asunto </td>
                        <td> Estado Documento </td>
                        <td> Empleado que Registro el Documento</td>
                        <td> Fecha Creacion </td>
                        <td> Ultima fecha actualizacion</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

