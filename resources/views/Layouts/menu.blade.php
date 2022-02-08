<!DOCTYPE html>
<html>
	<head>
		<title>GeCo @yield('title')</title>
		<link rel="icon"  type="image/png" href="images/email.png">	
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Baloo Bhaina 2' rel='stylesheet' type='text/css'>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>	
		@yield('funcionesjs')
		<style>
			* {
				margin: 0;
				padding: 0;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			}

			body {
				background: #e9e9e9;
				font-family: 'Baloo Bhaina 2', sans-serif;
				line-height: 18px;
			}
			#detalle{
				font-family: 'Baloo Bhaina 2', sans-serif;
				line-height: 18px;
				color: white;
			}
			a:link{
				text-decoration: none;
				color:#fff;
			}


			#sidebar{
				position: fixed;
				width: 247px;
				height: 100%;
				background: #204051;
				overflow: auto;
			}
		
			.title{
				margin-top: 50px;
				margin-bottom: 50px;
				border-top: 3px;
				color: #ffffff;
				text-align: center;
			}

			.btn-menu {
				display: none;
				padding: 20px;
				background: #0d2c44;
				color:#fff;
			}

			.btn-menu .icono {
				float: right;
			}

			.contenedor-menu {
				width: 0%;
				min-width: 246px;
				margin: 0px;
				display: inline-block;
				font-size: 15px;
				line-height: 18px;
			}

			.contenedor-menu .menu {
				width: 100%;
			}

			.contenedor-menu ul {
				list-style: none;
			}

			.contenedor-menu .menu li a {
				color:#ffffff;
				display: block;
				padding: 15px 20px;
				background: #204051;
			}
			.contenedor-menu .menu li button {
				width: 100%;
				color:#ffffff;
				display: block;
				padding: 15px 20px;
				text-align: left;
				background: #204051;
				border-color: transparent;
			}

			.contenedor-menu .menu li button:hover {
				background: #e9e9e9;
				color:#514d49;
			}

			.contenedor-menu .menu li a:hover {
				background: #e9e9e9;
				color:#514d49;
			}

			.contenedor-menu .menu .icono {
				font-size: 12px;
				line-height: 18px;
			}

			.contenedor-menu .menu .icono.izquierda {
				float: left;
				margin-right: 10px; 
			}

			.contenedor-menu .menu .icono.derecha {
				float: right;
				margin-left: 40px; 
			}

			.contenedor-menu .menu ul {
				display: none;
			}

			.contenedor-menu .menu ul li a {
				background: #204051;
				color:#ffffff;
			}

			.contenedor-menu .menu .activado > a {
				background: #204051;
				color:#fff;
			}

			@media screen and (max-width: 450px) {
				body {
					padding-top: 80px;
				}

				.contenedor-menu {
					margin: 0;
					width: 100%;
					position: fixed;
					top:0;
					z-index: 1000;
				}

				.btn-menu {
					display: block;
				}

				.contenedor-menu .menu {
					display: none;
				}
			}

			.content{
				left: 250px;
				height: 100%;
				width: 81%;
				position: absolute;
			}
			nav{
				left: 247px;
				height: 60px;
				position: absolute;
				background-color: #204051;

			}
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
				height: 360px;
				width: 99%;
				background:#bfc9ca;
				border-radius:15px;
				margin-top:3px;
				margin: 10px;
			}
			.document2{
				padding:5px;
				height: 120px;
				width: 90%;
				background:#bfc9ca;
				border-radius:15px;
				margin-top:3px;	
			}	
		</style>
		@yield('estilos')
	</head>
	<body>
		<div id="sidebar" class="float-left" >
			<h1 class="title">GeCo</h1>
			<div class="contenedor-menu">
				<ul class="menu">
					<li><a href="/"><i class="icono izquierda fa fa-home"></i>Inicio</a></li>
					<li><a ><i class="icono izquierda fa fa-home"></i>Usuario<i class="icono derecha fa fa-chevron-down"></i></a>
						<ul>
							<li>
								<button type="button" data-toggle="modal" data-target=".bd-example-modal-lg">Notificaciones</button>
							</li>
							<li><a href="/register">Crear Usuario</a></li>
						</ul>
					</li>
					<li><a href=""><i class="icono izquierda fa fa-file"></i>Corrsp. Enviada<i class="icono derecha fa fa-chevron-down"></i></a>
						<ul>
							<li><a href="/Enviada/create">Regis. Nuevo Documento</a></li>
							<li><a href="/Enviada">Documentos Enviados</a></li>
						</ul>
					</li>
					<li><a href="#"><i class="icono izquierda fa fa-envelope"></i>Corrsp. Recibida<i class="icono derecha fa fa-chevron-down"></i></a>
						<ul>
							<li><a href="/Recibida/create">Regis. Nueva Correspondencia Recibida</a></li>
							<li><a href="/Recibida/">Documentos Recibidos</a></li>
							<li><a href="/Buscar_Documento/create">Reparto Interno</a></li>
							<li><a href="/Buscar_Documento_a/create">Acciones</a></li>
							<li><a href="/Seguimiento/">Seguimiento</a></li>
							<li><a href="/Busqueda_Documentos/create">Busqueda Avanzada de Documentos</a></li>
						</ul>
					</li>
					
				</ul>
			</div>
			<br><br><br><br><br><br><hr style="margin: 20px; background-color: white;">
			<center>
				<p id="detalle">Usuario: {{Auth::user()->name}}</p>
				<p id="detalle">Base de Datos: pruebas</p>
			</center>
		</div>

		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      	<div class="modal-header">
				    <h5 class="modal-title" id="exampleModalLabel">Notificaciones</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
				</div>
			    <div class="modal-body">
			    	<div style="background-color: #204051;">	
			       <p class="float-left">{{$prueba}}</p>
			    	</div>
			    </div>
		    </div>
		  </div>
		</div>
				

		

		<div class="content">
			@yield('content')
		</div>

		<script>
			const btnToggle = document.querySelector('.toggle-btn');

			btnToggle.addEventListener('click', function () {
				document.getElementById('sidebar').classList.toggle('active');
			})
		</script>
		<script>
			$(document).ready(function(){
				$('.menu li:has(ul)').click(function(e){
					e.preventDefault();

					if ($(this).hasClass('activado')){
						$(this).removeClass('activado');
						$(this).children('ul').slideUp();
					} else {
						$('.menu li ul').slideUp();
						$('.menu li').removeClass('activado');
						$(this).addClass('activado');
						$(this).children('ul').slideDown();
					}
			});

			$('.btn-menu').click(function(){
				$('.contenedor-menu .menu').slideToggle();
			});

			$(window).resize(function(){
				if ($(document).width() > 450){
					$('.contenedor-menu .menu').css({'display' : 'block'});
				}

				if ($(document).width() < 450){
					$('.contenedor-menu .menu').css({'display' : 'none'});
					$('.menu li ul').slideUp();
					$('.menu li').removeClass('activado');
				}
			});

			$('.menu li ul li a').click(function(){
				window.location.href = $(this).attr("href");
			});
			});
		</script>
		<script type="text/javascript" src="jquery.dataTables.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
			    $('#d_enviados').DataTable({
		            "language": {
		                "decimal": "",
				        "emptyTable": "No hay información",
				        "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
				        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				        "infoFiltered": "(Filtrado de _MAX_ total Registros)",
				        "infoPostFix": "",
				        "thousands": ",",
				        "lengthMenu": "Mostrar _MENU_ Registros",
				        "loadingRecords": "Cargando...",
				        "processing": "Procesando...",
				        "search": "Buscar:",
				        "zeroRecords": "Sin resultados encontrados",
				        "paginate": {
				            "first": "Primero",
				            "last": "Ultimo",
				            "next": "Siguiente",
				            "previous": "Anterior"
				        }
		            }
		        } );
			} );
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>