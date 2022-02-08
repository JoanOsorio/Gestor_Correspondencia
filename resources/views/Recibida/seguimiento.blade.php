@extends('layouts.menu')

@section('title','Seguimiento')

@section('estilos')
<style type="text/css">
  
    .document2{
      width: 100%;
      height: 290px;
    }
    .marcoTablePro {
        width: 100%;
        height: 240px;
        font-size: 13px;
        padding: 10px;
     
    }
    .a{
    overflow-x:hidden; overflow-y:scroll;"
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
        label{
      font-size: 14px;
    }
    
</style>
@endsection

@section('content')
<div style="width: 100%; height:100%;" class="container">
    <div class="float-left" style="width: 36%; height: 100%; padding: 30px;" >
        <center>
            <h2>Datos del Documento</h2>
        </center>
        <br><br>
         @foreach($c_recibida as $recibida)

      <label><b>Codigo Documento: </b></label>
      <label>{{$recibida->cr_codigo}}</label>
      <br>
      <label><b>Medio de Entrega: </b></label>
      <label>{{$recibida->medent_nombre}}</label>
      <br>
      <label><b>Fecha del Documento: </b></label>
      <label>{{$recibida->cr_fecha_documento}}</label>
      <br>
      <label><b>Fecha de Recepcion del Documento: </b></label>
      <label>{{$recibida->cr_fecha_recepcion}}</label>
      <br>
      <label><b>Tipo de Documento: </b></label>
      <label>{{$recibida->tipdoc_nombre}}</label>
      <br>
      <label><b>Nombre del Destinatario: </b></label>
      <label>{{$recibida->cr_nombre_destinatario}}</label>
      <br>
      <label><b>Empresa Destinatario: </b></label>
      <label>{{$recibida->emp_nombre}}</label>
      <br>
      <label><b>Nombre del Remitente: </b></label>
      <label>{{$recibida->cr_nombre_remitente}}</label>
      <br>
      <label><b>Empresa Remitente: </b></label>
      <label>{{$recibida->cr_empresa_remitente}}</label>
      <br>
      <label><b>Tipo de Remitente: </b></label>
          <label>{{$recibida->tiprem_nombre}}</label>
      <br>
      <label><b>Referencia o Codigo: </b></label>
      <label>{{$recibida->cr_referencia}}</label>
      <br>
      <label><b>Asunto:</b></label>
      <label>{{$recibida->cr_asunto}}</label>
      <br>
      <label><b>Estado del Dcumento: </b></label>
          <label>{{$recibida->estdoc_nombre}}</label>
      <br>
      <label><b>Empleado que registro el Documento: </b></label>
      <label>{{$recibida->cr_empleado}}</label>

      @endforeach
      <br><br><br><br><br>
      <center>
          <a class="btn btn-danger" href="/Seguimiento">Salir</a>
      </center>
    </div>
    <br>
    <div class="float-left " style="width: 64%; height: 98%">
      <div class="document2">
        <div >
          <center>
            <h5>Repartos</h5>
          </center>
       
      <div class="marcoTablePro a">
        <table class="table table-bordered table-condensed table-pro" >
            <thead>
            <tr>
             <td> Entregado por </td>
              <td> Entregado a </td>
              <td> Forma Envio </td>
              <td> Fecha Entrega </td>
            </tr>
          </thead>
          <tbody>
              @foreach($repartos as $rep)
              <tr>
                <td> {{$rep->rep_empleado}} </td>
                <td> {{$rep->name}} </td>
                <td> {{$rep->medent_nombre}} </td>
                <td> {{$rep->rep_fecha_reparto}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
          </div>
        </div>
      </div>
      <hr>
      <div class="document2">
            <div >
          <center>
            <h5>Acciones</h5>
          </center>
       
      <div class="marcoTablePro a">
        <table class="table table-bordered table-condensed table-pro" >
                       <thead>
            <tr>
              <td> Fecha Accion </td>
              <td> Tipo de Accion </td>
              <td> Observaciones </td>
              <td> Usuario que realizo la Accion </td>
            </tr>
          </thead>
          <tbody>
             @foreach($acciones as $accion)
                <tr>
                    <td> {{$accion->acc_fecha_accion}} </td>
                    <td> {{$accion->tipacc_nombre}} </td>
                    <td> {{$accion->acc_observaciones}} </td>
                    <td> {{$accion->acc_empleado}} </td>
                </tr>
              @endforeach
          </tbody>
        </table>
          </div>
        </div>
      </div>
      </div>
    </div>
    
@endsection

@section('funcionesjs')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
@endsection
  