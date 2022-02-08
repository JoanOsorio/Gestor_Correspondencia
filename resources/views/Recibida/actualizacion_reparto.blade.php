@extends('layouts.menu')

@section('title','Reparto Interno')

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
        <h2>Reparto Interno</h2>
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
          <a class="btn btn-danger" href="/Buscar_Documento/create">Salir</a>
      </center>
    </div>
    <br>
    <div class="float-left " style="width: 64%; height: 98%">
      @foreach($reparto as $rep)
      <form class="form-group" method="POST" action="/Reparto/{{$rep->rep_id}}">
      @endforeach
        @csrf
        @method('PUT')
        <div class="document2">
          <div >
            <center>
              <h5>Actualizar Reparto</h5>
            </center>
            <div class="form2 float-left">
                <label>
                @foreach($c_recibida as $recibida)
                <input type="hidden" value="{{$recibida->cr_id}}" name="codigo_c_recibida">
                @endforeach
                </label>
                @foreach($reparto as $rep)
                  <label>Fecha del Reparto</label>
                  <input required="" type="date" class="form-control" name="fecha_reparto" value="{{$rep->rep_fecha_reparto}}">
                @endforeach  
            </div>
            <div class="form2 float-left">
              <label>Medio de Entrega</label>
              <select class="form-control" name="medio_entrega">
                <option class="form-control">--Seleccione--</option>
                @foreach($medio_entregas as $medio)
                @foreach($reparto as $rep)
                  @if($rep->rep_medio_reparto == $medio->medent_id)
                    <option class="form-control" value="{{$medio->medent_id}}" selected="">{{$medio->medent_nombre}}</option>
                  @else
                    <option class="form-control" value="{{$medio->medent_id}}" >{{$medio->medent_nombre}}</option>
                  @endif
                 @endforeach 
                @endforeach 
              </select>
            </div>
            <div class="float-left" style="width: 90%; margin: 30px;">
              <center>
                <label>Enviado a</label>
              </center>
              <select class="form-control" name="enviado_a">
                <option class="form-control">--Seleccione--</option>
                @foreach($usuarios as $usuario)
                  @foreach($reparto as $rep)
                    @if($rep->rep_empleado_reparto == $usuario->id)
                      <option class="form-control" value="{{$usuario->id}}" selected="">{{$usuario->name}}</option>
                    @else
                      <option class="form-control" value="{{$usuario->id}}" >{{$usuario->name}}</option>
                    @endif
                  @endforeach 
                @endforeach 
              </select>
            </div>
            <br><br>
            <center>
              <div class="form2 ">
                <button type="submit" class="btn btn-success">Actualizar</button>
              <form class="form-group" method="POST" action="/Buscar_Documento/create" >
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
            <h5>Repartos</h5>
          </center>
       
      <div class="marcoTablePro a">
        <table class="table table-bordered table-condensed table-pro" >
            <!--//foreach de consulta where id para el hidden --> 
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
      </div>
  </div>   
@endsection

@section('funcionesjs')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
@endsection
  