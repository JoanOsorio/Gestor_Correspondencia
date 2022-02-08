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
	<form class="form-group" method="POST" action="/Recibida" enctype="multipart/form-data">
		@csrf
		<br><br>
		<div class="titulo ">
			<h2>Registro de Nuevo Documento Recibido</h2>
			<center><p>Registrar una nueva correspondencia Recibida</p></center>
		</div>
		<br>
		<div class="document panel panel-default">
			<div>
				<center>
					<br>
					<h5>Datos del Documento</h5>
				</center>
			</div>
			<div class="form2 float-left">
				<label>Codigo</label>
				<input type="hidden" name="codigo_r" value="{{$nombre_r}}" name="codigo_r">
				<input required="" disabled="" value="{{$nombre_r}}" type="text" class="form-control" name="codigo">
			</div>
			<div class="form2 float-left">
				<label>Medio de Entrega</label>
				<select class="form-control" name="medio_entrega">
					<option class="form-control">--Seleccione--</option>
					@foreach($c_recibida2 as $c_recibida)
						<option class="form-control" value={{$c_recibida->medent_id}}>{{$c_recibida->medent_nombre}}</option>
					@endforeach	
				</select>
			</div>
			<div class="form float-left">
				<label>Fecha del Documento</label>
				<input required="" type="date" class="form-control" name="fecha_documento">
			</div>
			<div class="form float-left">
				<label>Fecha de recepcion</label>
				<input required="" type="date" class="form-control" name="fecha_recepcion">
			</div>
			<div class="form2 float-left">
				<center>
					<label>Tipo de Documento</label>
				</center>
				<select class="form-control" name="tipo_documento">
					<option class="form-control">--Seleccione--</option>
					@foreach($c_recibida3 as $c_recibida)
						<option class="form-control" value={{$c_recibida->tipdoc_id}}>{{$c_recibida->tipdoc_nombre}}</option>
					@endforeach	
				</select>
			</div>
			<div class=" form float-left">
				<label>Nombre del Destinatario</label>
				<input required="" type="text" name="nombre_destinatario" class="form-control" >
			</div>	
			<div class="form float-left">
				<center>
					<label>Empresa Destinatario</label>
				</center>
				<select class="form-control" name="empresa_destinatario">
					<option class="form-control">--Seleccione--</option>
					@foreach($c_recibida1 as $c_recibida)
						<option class="form-control" value={{$c_recibida->emp_id}}>{{$c_recibida->emp_nombre}}</option>
					@endforeach	
				</select>
			</div>		
			<div class=" form2 float-left">
				<label>Nombre del Remitente</label>
				<input required="" type="text" name="nombre_remitente" class="form-control">
			</div>	
			<div class="form float-left">
				<label>Empresa del Remitente</label>
				<input required="" type="text" name="empresa_remitente" class="form-control">
			</div>	
			<div class="form float-left">
				<center>
					<label>Tipo de Remitente</label>
				</center>
				<select class="form-control" name="tipo_remitente">
					<option class="form-control">--Seleccione--</option>
					@foreach($c_recibida4 as $c_recibida)
						<option class="form-control" value={{$c_recibida->tiprem_id}}>{{$c_recibida->tiprem_nombre}}</option>
					@endforeach		
				</select>
			</div>		
			<div class="form2 float-left">
				<label>Radicado o Codigo del Documento</label>
				<input required="" type="text" name="referencia" class="form-control">
			</div>	
			<div class=" form2 float-left">
				<label>Asunto o Tema</label>
				<input required="" type="text" class="form-control" name="asunto">
			</div>	
			<div class="float-left" style="width: 45%; margin-left:300px; margin-top: 15px; text-align: center;">
				<label>Subir Documento</label>
				<input required="" type="file" class="form-control" name="documento" accept="application/pdf" style="width: 100%; text-align: center; ">
			</div>	
		</div>
		<br>
		<center>
			<div class="form2 ">
				<button type="submit" class="btn btn-success">Guardar</button>
				<a class="btn btn-danger" href="/Recibida/">Cancelar</a>
			</div>	
		</center>
	</form>
@endsection
