<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>Registro</title>
		<link rel="stylesheet" href="/survey/views/static/css/style.css">
	</head>
	<body>
		<nav class="navbar">
			<!-- Encuestado -->
			<span class="slide">
				<a href="/survey" id="icono">
					<svg width="30" height="30">
						<path d="M0,5 30,5" stroke="#fff" stroke-width="5"/>
						<path d="M0,14 30,14" stroke="#fff" stroke-width="5"/>
						<path d="M0,23 30,23" stroke="#fff" stroke-width="5"/>
					</svg>
					<font style="margin-left:10px;position:absolute;top:22px;">Survey's</font>
				</a>
			</span>

			<ul class="navbar-nav">
				<li><a href="/survey">&#128235;Inicio de Sesión</a></li>
				<!-- <li><a href="#">Username</a></li> -->
			</ul>
			<!-- Encuestado -->
		</nav>

		<div id="main">
			<h2>Registro de Usuario</h2>
			<?php 
				//Mostrar Alert
				if (isset($is_registered)) {
					if($is_registered){
					echo '<div class="alert alert-info">El Usuario Ha Sido Registrado Exitosamente, Ya Puede <a href="/survey">Iniciar Sesión Aqui.</a></div>';
					}else{
						echo '<div class="alert alert-error">Nombre de Usuario No Disponible.</div>';
					}
				}
			?>
			<form action="#" method="post">
				<div class="form">
					
					<label for="user">Usuario:</label>
					<input type="text" autocomplete="off" name="user" id="user" placeholder="Ingrese Nombre de Usuario">

					<label for="pass">Contraseña:</label>
					<input type="password" name="pass" id="pass" placeholder="Ingrese Contraseña">

					<label for="name">Nombre y Apellido:</label>
					<input type="text" autocomplete="off" name="name" id="name" placeholder="Ingrese Nombre y Apellido">

					<label for="email">Email:</label>
					<input type="email" autocomplete="off" name="email" id="email" placeholder="Ingrese Email">
					
				</div>
				<input type="submit" name="boton" value="Registrar" class="btn" style="margin-top:1em;">
			</form>
		</div>

		<div class="footer">
			<br><p>Creado por Alexander Arellano & Victor Rivas</p>
		</div>
	</body>
</html>