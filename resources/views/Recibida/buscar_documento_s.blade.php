@extends('layouts.menu')

@section('title','Buscar Documento')

@section('estilos')
  <style type="text/css">
    .form2{
		margin:10px;
		width:290px;
		font-size:15px;
		text-align:center;
	}
	.document{
		height: 170px;
		width: 28%;
		background:#bfc9ca;
		border-radius:15px;
		margin-top:100px;
		margin-left: 400px;
	}
	label{
		margin-top: 20px;
	}
	.inp{
		margin-top: 20px;
	}
  </style>
@endsection

@section('content')
	<center>
		<br><br><br>
		<h1>Seguimiento</h1>
		<br>
		 @if(session('status'))
		 	<p>Ingrese el codigo del documento para ver el reparto y las acciones realizadas</p>
		        <div class="alert alert-danger" style="margin-left:0px; margin-bottom: 0px;">
		            {{session('status')}}
		        </div>
		    @else
		        <p>Ingrese el codigo del documento para ver el reparto y las acciones realizadas</p>
		    @endif 
	</center>
    <form class="form-group" method="POST" action="/Seguimiento/">
    	@csrf
    	<div class="document">
	    	<div class="form2">
	    		<label>Ingrese el Codigo unico del Documento</label>
	    		<input required="" type="text" name="codigo" class="form-control inp">
	    		<br>
	    		<button class="btn btn-success">Buscar</button>
	    	</div>
    	</div>
    </form>
@endsection

  