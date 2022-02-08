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
        <h2>Reparto Interno</h2>
      </center>
      <br>
      <br>
      <label><b>Codigo Documento: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_codigo}}
        </label>
      @endforeach
      <br>
      <label><b>Medio de Entrega: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->medent_nombre}}
        </label>
      @endforeach
      <br>
      <label><b>Fecha del Documento: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_fecha_documento}}
        </label>
      @endforeach
      <br>
      <label><b>Fecha de Recepcion del Documento: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_fecha_recepcion}}
        </label>
      @endforeach
      <br>
      <label><b>Tipo de Documento: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->tipdoc_nombre}}
        </label>
      @endforeach
      <br>
      <label><b>Nombre del Destinatario: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_nombre_destinatario}}
        </label>
      @endforeach
      <br>
      <label><b>Empresa Destinatario: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->emp_nombre}}
        </label>
      @endforeach
      <br>
      <label><b>Nombre del Remitente: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_nombre_remitente}}
        </label>
      @endforeach
      <br>
      <label><b>Empresa Remitente: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_empresa_remitente}}
        </label>
      @endforeach
      <br>
      <label><b>Tipo de Remitente: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->tiprem_nombre}}
        </label>
      @endforeach
      <br>
      <label><b>Referencia o Codigo: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_referencia}}
        </label>
      @endforeach
      <br>
      <label><b>Asunto:</b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_asunto}}
        </label>
      @endforeach
      <br>
      <label><b>Estado del Documento: </b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->estdoc_nombre}}
        </label>
      @endforeach
      <br>
      <label><b>Empleado que registro el Documento:</b></label>
      @foreach (Session::get('c_recibida') as $recibida)
        <label>
          {{$recibida->cr_empleado}}
        </label>
      @endforeach
      <br><br>
      <center>
       <a class="btn btn-danger" href="/Buscar_Documento/create">Cancelar</a>
      </center>
    </div>
    <br>
    <div class="float-left " style="width: 64%; height: 98%">
      <form class="form-group" method="POST" action="/Reparto/">
        @csrf
        <div class="document2">
          <div >
            <center>
              <h5>Generar Reparto</h5>
            </center>
            <div class="form2 float-left">
               @foreach (Session::get('c_recibida') as $recibida)
                <label>
                <input type="hidden" value="{{$recibida->cr_id}}" name="codigo_c_recibida">
                </label>
              @endforeach
              <label>Fecha del Reparto</label>
              <input required="" type="date" class="form-control" name="fecha_reparto">
            </div>
            <div class="form2 float-left">
              <label>Medio de Entrega</label>
              <select class="form-control" name="medio_entrega">
                <option class="form-control">--Seleccione--</option>
                <@foreach (Session::get('medio_entregas') as $medio_entrega)
                  <option class="form-control" value={{$medio_entrega->medent_id}}>{{$medio_entrega->medent_nombre}}</option>
                @endforeach
              </select>
            </div>
            <div class="float-left" style="width: 90%; margin: 30px;">
              <center>
                <label>Enviado a</label>
              </center>
              <select class="form-control" name="enviado_a">
                <option class="form-control">--Seleccione--</option>
                <@foreach (Session::get('usuarios') as $usuario)
                  <option class="form-control" value={{$usuario->id}}>{{$usuario->name}}</option>
                @endforeach
              </select>
            </div>
            <br><br>
            <center>
              <div class="form2 ">
                <button type="submit" class="btn btn-success">Guardar</button>
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
              <td> Edicion </td>
              <td> Entregado por </td>
              <td> Entregado a </td>
              <td> Forma Envio </td>
              <td> Fecha Entrega </td>
            </tr>
          </thead>
          <tbody>
              @foreach(Session::get('repartos') as $reparto)
                <tr>
                   <td>
                    <center>
                        <form class="form-group2" method="POST" action="/Reparto/{{$reparto->rep_id}}">
                            @method('DELETE')
                            @csrf
                            <a href="/Reparto/{{$reparto->rep_id}}/edit">
                               <i class="fa fa-pencil-square btn btn-warning botom"></i>
                            </a>
                            <button type="submit" class="btn btn-danger botom2">
                                <i class="fa fa-trash-o "></i>
                            </button>
                        </form>
                    </center>
                    </td>
                    <td> {{$reparto->rep_empleado}} </td>
                    <td> {{$reparto->name}} </td>
                    <td> {{$reparto->medent_nombre}} </td>
                    <td> {{$reparto->rep_fecha_reparto}}</td>
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
  