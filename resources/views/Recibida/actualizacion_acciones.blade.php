@extends('layouts.menu')

@section('title','Acciones')

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
    .form-group2{
      margin-bottom: 0rem;
    }
  </style>
@endsection

@section('content')
  <div style="width: 100%; height:100%;" class="container">
    <div class="float-left" style="width: 36%; height: 100%; padding: 30px;" >
      <center>
        <h2>Acciones</h2>
      </center>
      <br>
      <br>
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
      <br><br>
      @endforeach
      <center>
       <a class="btn btn-danger" href="/Buscar_Documento_a/create">Salir</a>
      </center>
    </div>
    <br>
    <div class="float-left " style="width: 64%; height: 98%">
      @foreach($accion as $acc)
      <form class="form-group" method="POST" action="/Acciones/{{$acc->acc_id}}">
      @endforeach
        @csrf
        @method('PUT')
        <div class="document2">
          <div >
            <center>
              <h5>Actualizar Accion</h5>
            </center>
            <div class="form2 float-left">
               @foreach($c_recibida as $recibida)
                <input type="hidden" value="{{$recibida->cr_id}}" name="codigo_c_recibida">
                @endforeach
               @foreach($accion as $acc)
                  <label>Fecha de la Accion</label>
                  <input required="" type="date" class="form-control" name="fecha_accion" value="{{$acc->acc_fecha_accion}}">
                @endforeach
            </div>
            <div class="form2 float-left">
              <label>Tipo Accion</label>
              <select class="form-control" name="tipo_accion">
                <option class="form-control">--Seleccione--</option>
                @foreach($tipo_acciones as $tipo)
                @foreach($accion as $acc)
                  @if($acc->acc_tipo_accion == $tipo->tipacc_id)
                    <option class="form-control" value="{{$tipo->tipacc_id}}" selected="">{{$tipo->tipacc_nombre}}</option>
                  @else
                    <option class="form-control" value="{{$tipo->tipacc_id}}" >{{$tipo->tipacc_nombre}}</option>
                  @endif
                 @endforeach 
                @endforeach 
              </select>
            </div>
            <div class="float-left" style="width: 90%; margin: 30px;">
               @foreach($accion as $acc)
                  <label>Observaciones</label>
                  <input required="" type="text" class="form-control" name="observaciones" value="{{$acc->acc_observaciones}}">
                @endforeach
            </div>
            <br><br>
            <center>
              <div class="form2 ">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <form class="form-group" method="POST" action="/Buscar_Documento_a/create" >
                <label>
                @foreach($c_recibida as $recibida)
                <input type="hidden" value="{{$recibida->cr_id}}" name="codigo_c_recibida">
                @endforeach
                </label>
                <button type="submit" class="btn btn-danger">Cancelar</button>
              </form>
              </div>  
            </center>
          </div>
        </div>
      </form>
      <hr>
      <div class="document2">
            <div >
          <center>
            <h5>Acciones</h5>
          </center>
       
      <div class="marcoTablePro a">
        <table class="table table-bordered table-condensed table-pro" >
            <!--//foreach de consulta where id para el hidden --> 
            <thead>
            <tr>
              <td> Fecha Accion </td>
              <td> Tipo de Accion </td>
              <td> Observaciones </td>
            </tr>
          </thead>
          <tbody>
              @foreach($acciones as $accion)
                <tr>
                    <td> {{$accion->acc_fecha_accion}} </td>
                    <td> {{$accion->tipacc_nombre}} </td>
                    <td> {{$accion->acc_observaciones}} </td>
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
  