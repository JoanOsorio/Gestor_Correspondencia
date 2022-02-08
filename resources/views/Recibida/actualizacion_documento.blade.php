@extends('layouts.menu')

@section('title','Actualizacion Documeto')

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
	<form class="form-group" method="POST" action="/Recibida/{{$c_recibida->slug}}" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<br><br>
		<div class="titulo ">
			<h2>Actualizacion de un Documento Recibido</h2>
			<center>
				<p>Muestra los datos de un documento recibido. Permite realizar actualizaciones de sus datos</p>
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
			<div class="form2 float-left">
				<label>Codigo</label>
				<input type="hidden" value="{{$c_recibida->cr_codigo}}" name="codigo">
				<input required="" disabled="" value="{{$c_recibida->cr_codigo}}" type="text" class="form-control">
			</div>
			<div class="form2 float-left">
				<label>Medio de Entrega</label>
				<select class="form-control" name="medio_entrega">
					<option class="form-control">--Seleccione--</option>
					@foreach($medio_entregas as $medio)
						@if($c_recibida->cr_medio_entrega== $loop->index+1)
							<option class="form-control" value="{{$loop->index+1}}" selected="">{{$medio->medent_nombre}}</option>
						@else
							<option class="form-control" value="{{$loop->index+1}}" >{{$medio->medent_nombre}}</option>
						@endif
					@endforeach	
				</select>
			</div>
			<div class="form float-left">
				<label>Fecha del Documento</label>
				<input value="{{$c_recibida->cr_fecha_documento}}" required="" type="date" class="form-control" name="fecha_documento" >
			</div>
			<div class="form float-left">
				<label>Fecha de recepcion</label>
				<input value="{{$c_recibida->cr_fecha_recepcion}}" required="" type="date" class="form-control" name="fecha_recepcion">
			</div>
			<div class="form2 float-left">
				<center>
					<label>Tipo de Documento</label>
				</center>
				<select class="form-control" name="tipo_documento" >
					<option class="form-control">--Seleccione--</option>
					@foreach($tipo_documentos as $tipo_d)
						@if($c_recibida->cr_tipo_documento == $loop->index+1)
							<option class="form-control" value="{{$loop->index+1}}" selected="">{{$tipo_d->tipdoc_nombre}}</option>
						@else
							<option class="form-control" value="{{$loop->index+1}}" >{{$tipo_d->tipdoc_nombre}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class=" form float-left">
				<label>Nombre del Destinatario</label>
				<input value="{{$c_recibida->cr_nombre_destinatario}}" required="" type="text" name="nombre_destinatario" class="form-control" >
			</div>	
			<div class="form float-left">
				<center>
					<label>Empresa Destinatario</label>
				</center>
				<select class="form-control" name="empresa_destinatario">
					<option class="form-control">--Seleccione--</option>
					@foreach($empresas as $empresa)
							@if($c_recibida->cr_empresa_destinatario == $loop->index+1)
								<option class="form-control" value="{{$loop->index+1}}" selected="">{{$empresa->emp_nombre}}</option>
							@else
								<option class="form-control" value="{{$loop->index+1}}" >{{$empresa->emp_nombre}}</option>
							@endif
					@endforeach
				</select>
			</div>		
			<div class=" form2 float-left">
				<label>Nombre del Remitente</label>
				<input value="{{$c_recibida->cr_nombre_remitente}}" required="" type="text" name="nombre_remitente" class="form-control">
			</div>	
			<div class="form float-left">
				<label>Empresa del Remitente</label>
				<input value="{{$c_recibida->cr_empresa_remitente}}" required="" type="text" name="empresa_remitente" class="form-control">
			</div>	
			<div class="form float-left">
				<center>
					<label>Tipo de Remitente</label>
				</center>
				<select class="form-control" name="tipo_remitente">
					<option class="form-control">--Seleccione--</option>
					@foreach($tipo_remitentes as $remitente)
							@if($c_recibida->cr_tipo_remitente == $loop->index+1)
								<option class="form-control" value="{{$loop->index+1}}" selected="">{{$remitente->tiprem_nombre}}</option>
							@else
								<option class="form-control" value="{{$loop->index+1}}" >{{$remitente->tiprem_nombre}}</option>
							@endif
					@endforeach		
				</select>
			</div>		
			<div class="form2 float-left">
				<label>Radicado o Codigo del Documento</label>
				<input value="{{$c_recibida->cr_referencia}}" required="" type="text" name="referencia" class="form-control">
			</div>	
			<div class=" form2 float-left">
				<label>Asunto o Tema</label>
				<input value="{{$c_recibida->cr_asunto}}" required="" type="text" class="form-control" name="asunto">
			</div>	
			<div class="float-left" style="width: 45%; margin-left:300px; margin-top: 15px; text-align: center;">
				<label>Actualizar Documento</label>
				<input type="file" class="form-control" name="documento" accept="application/pdf" style="width: 100%; text-align: center; ">
			</div>	
		</div>
		<br>
		<center>
			<div class="form2 ">
				<button type="submit" class="btn btn-success">Actualizar</button>
				<a class="btn btn-danger" href="/Recibida/">Cancelar</a>
			</div>	
		</center>
	</form>
@endsection
