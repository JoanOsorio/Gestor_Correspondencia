@extends('layouts.menu')

@section('title','Actualizacion Documento')

@section('content')
	<form class="form-group" method="POST" action="/Enviada/{{$c_enviada->slug}}" enctype="multipart/form-data">
		@method('PUT')
		@csrf
		<div class="titulo ">
			<h2>Actualizacion y/o Datos de la Entrega del Documento</h2>
			<center>
				<p>Muestra los datos de un envio en especifico. Permite realizar actualizaciones de sus datos y registrar los datos de la entrega del documento</p>
			</center>
		</div>
		<div class="document panel panel-default">
			<div>
				<center>
					<br>
					<h5>Datos del Documento</h5>
				</center>
			</div>
			<div class="form float-left">
				<label>Codigo</label>
				<input type="hidden" value="{{$c_enviada->ce_codigo}}" name="codigo">
				<input required="" disabled="" value="{{$c_enviada->ce_codigo}}" type="text" class="form-control">
			</div>
			<div class="form float-left">
				<label>Fecha del Documento</label>
				<input required="" type="date" class="form-control" name="fecha_documento" value="{{$c_enviada->ce_fecha_creacion_documento}}">
			</div>
			<div class="form2 float-left">
				<center>
					<label>Empresa Remitente</label>
				</center>
				<select class="form-control" name="empresa_remitente" >
					<option class="form-control">--Seleccione--</option>
						@foreach($c_enviadas2 as $c_enviada2)
							@if($c_enviada->ce_empresa_remitente == $loop->index+1)
								<option class="form-control" value="{{$loop->index+1}}" selected="">{{$c_enviada2->emp_nombre}}</option>
							@else
								<option class="form-control" value="{{$loop->index+1}}" >{{$c_enviada2->emp_nombre}}</option>
							@endif
						@endforeach
				</select>
			</div>		
			<div class=" form2 float-left">
				<label>Documento Firmado por</label>
				<input required="" type="text" class="form-control" name="firma_responsable" value="{{$c_enviada->ce_firma_responsable}}">
			</div>
			<div class=" form2 float-left">
				<label>Nombre del Destinatario</label>
				<input required="" type="text" name="nombre_destinatario" class="form-control" name="nombre_destinatario" value="{{$c_enviada->ce_nombre_destinatario}}" >
			</div>
			<div class=" form2 float-left">
				<label>Empresa del Destinatario</label>
				<input required="" type="text" class="form-control" name="empresa_destinatario" value="{{$c_enviada->ce_empresa_destinatario}}" >
			</div>
			<div class=" form3 float-left">
				<label>Asunto o Tema</label>
				<input required="" type="text" class="form-control" name="asunto" value="{{$c_enviada->ce_asunto}}" >
			</div>			
			<div class="form float-left">
				<center>
					<label>Requiere Seguimiento</label>
				</center>
				<select class="form-control" name="seguimiento" >
					<option class="form-control">--Seleccione--</option>
						@if($c_enviada->ce_estado_seguimiento == 1)
							<option class="form-control" value=1 selected="">Si</option>
							<option class="form-control" value=2>No</option>		
						@else
							<option class="form-control" value=1>Si</option>
							<option class="form-control" value=2 selected="">No</option>		
						@endif	
				</select>
			</div>	
			<div class="form float-left">
				<label>Respuesta a</label>
				<input required="" type="text" class="form-control" name="respuesta_a" value="{{$c_enviada->ce_respuesta_a}}">
			</div>
			<div class="form2 float-left">
				<label>Observaciones</label>
				<input required="" type="text" class="form-control" name="observaciones" value="{{$c_enviada->ce_observaciones}}">
			</div>
			<div class="form2 float-left">
				<label>Forma de Entrega</label>
				<select class="form-control" name="forma_entrega" >
					<option class="form-control">--Seleccione--</option>
					@foreach($c_enviadas3 as $c_enviada3)
						@if($c_enviada->ce_forma_entrega == $loop->index+1)
							<option class="form-control" value="{{$loop->index+1}}" selected="">{{$c_enviada3->forent_nombre}}</option>
						@else
							<option class="form-control" value="{{$loop->index+1}}" >{{$c_enviada3->forent_nombre}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<center>
				<div class=" form3 ">
					<label>Actualizar Documento</label>
					<input type="file" class="form-control" name="documento" accept="application/pdf" value="/documentos/enviados/{{$c_enviada->ce_documento}}">
				</div>	
			</center>
		</div>
		<hr>
		<center>
			<div class="document2">
				<div>
					<center>
						<h5>Datos de la Entrega del Documento</h5>
					</center>
				</div>
				<div class="form2 float-left">
					<label>Estado de la Entrega</label>
					<select class="form-control" name="estado_entrega" >
						<option class="form-control">--Seleccione--</option>
						@foreach($c_enviadas4 as $c_enviada4)
							@if($c_enviada->ce_estado_entrega == $loop->index+1)
								<option class="form-control" value="{{$loop->index+1}}" selected="">{{$c_enviada4->estent_nombre}}</option>
							@else
								<option class="form-control" value="{{$loop->index+1}}" >{{$c_enviada4->estent_nombre}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="form2 float-left">
					<label>Fecha de Entrega</label>
					<input type="date" class="form-control" name="fecha_entrega" value="{{$c_enviada->ce_fecha_entrega}}">
				</div>
				<div class="form2 float-left">
					<label>Hora de Entrega</label>
					<input type="time" class="form-control" name="hora_entrega" value="{{$c_enviada->ce_hora_entrega}}">
				</div>
			</div>
		</center>
		<center>
			<div class="form2 ">
				<button type="submit" class="btn btn-success">Actualizar</button>
				<a class="btn btn-danger" href="/Enviada/">Cancelar</a>
			</div>	
		</center>
	</form>
@endsection
