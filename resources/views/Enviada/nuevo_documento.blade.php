@extends('layouts.menu')

@section('title','Registro Documento Nuevo')

@section('estilos')
	<style type="text/css">
		.form{
			margin:10px;
			width:200px;
			font-size:15px;
			text-align:center;
		}
		.form2{
			margin:10px;
			width:290px;
			font-size:15px;
			text-align:center;
		}
		.form3{
			margin:10px;
			width:400px;
			font-size:15px;
			text-align:center;
		}
		.titulo{
			text-align:center;
			margin:20px;
		}
		.form-control{
			font-size:12px;
		}
		.document{
			height: 380px;
			width: 99%;
			background:#bfc9ca;
			border-radius:15px;
			margin-top:3px;
			margin: 10px;
		}
		.document2{
			padding:5px;
			height: 150px;
			width: 90%;
			background:#bfc9ca;
			border-radius:15px;
			margin-top:3px;	
		}
	</style>
@endsection

@section('content')
	<form class="form-group" method="POST" action="/Enviada/" enctype="multipart/form-data">
		@csrf
		<br><br>
		<div class="titulo ">
			<h2>Registro de Nuevo Documento Enviado</h2>
			<center>
				<p>Registrar una nueva correspondencia la cual sera despachada posteriormente</p>
			</center>
		</div>
		<br>
		<div class="document panel panel-default">
			<div>
				<center>
					<br>
					<h5>Datos del Documento</h5>
				</center>
			</div>
			<div class="form float-left">
				<label>Codigo</label>
				<input type="hidden" value="{{$nombre_r}}" name="codigo">
				<input required="" disabled="" value="{{$nombre_r}}" type="text" class="form-control">
			</div>
			<div class="form float-left">
				<label>Fecha del Documento</label>
				<input required="" type="date" class="form-control" name="fecha_documento">
			</div>
			<div class="form2 float-left">
				<center>
					<label>Empresa Remitente</label>
				</center>
				<select class="form-control" name="empresa_remitente">
					<option class="form-control">--Seleccione--</option>
					@foreach($c_enviadas as $c_enviada)
						<option class="form-control" value={{$c_enviada->emp_id}}>{{$c_enviada->emp_nombre}}</option>
					@endforeach	
				</select>
			</div>		
			<div class=" form2 float-left">
				<label>Documento Firmado por</label>
				<input required="" type="text" class="form-control" name="firma_responsable">
			</div>
			<div class=" form2 float-left">
				<label>Nombre del Destinatario</label>
				<input required="" type="text" name="nombre_destinatario" class="form-control" name="nombre_destinatario" >
			</div>
			<div class=" form2 float-left">
				<label>Empresa del Destinatario</label>
				<input required="" type="text" class="form-control" name="empresa_destinatario">
			</div>
			<div class=" form3 float-left">
				<label>Asunto o Tema</label>
				<input required="" type="area" class="form-control" name="asunto">
			</div>			
			<div class="form float-left">
				<center>
					<label>Requiere Seguimiento</label>
				</center>
				<select class="form-control" name="seguimiento">
					<option class="form-control">--Seleccione--</option>
					<option class="form-control" value=1>Si</option>
					<option class="form-control" value=2>No</option>		
				</select>
			</div>	
			<div class="form float-left">
				<label>Respuesta a</label>
				<input required="" type="text" class="form-control" name="respuesta_a">
			</div>
			<div class="form3 float-left">
				<label>Observaciones</label>
				<input required="" type="text" class="form-control" name="observaciones">
			</div>
			<div class="form float-left">
				<label>Forma de Entrega</label>
				<select class="form-control" name="forma_entrega"> 
					<option class="form-control">--Seleccione--</option>
					@foreach($c_enviadas2 as $c_enviada)
						<option class="form-control" value={{$c_enviada->forent_id}}>{{$c_enviada->forent_nombre}}</option>
					@endforeach	
				</select>
			</div>
			<br>
			<center>
				<div class=" form3 ">
					<label>Subir Documento</label>
					<input type="file" class="form-control" name="documento" accept="application/pdf">
				</div>	
			</center>
		</div>
		<center>
			<div class="form2 ">
				<button type="submit" class="btn btn-success">Guardar</button>
				<a class="btn btn-danger" href="/Enviada/">Cancelar</a>
			</div>	
		</center>
	</form>
@endsection
