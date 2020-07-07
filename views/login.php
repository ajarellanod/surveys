<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>Inicio de Sesión</title>
		<link rel="stylesheet" href="/survey/views/static/css/style.css">
	</head>
	<body>
		<nav class="navbar">
			<!-- Encuestado -->
			<span class="slide">
				<a href="#" id="icono" onclick="openSideMenu()">
					<svg width="30" height="30">
						<path d="M0,5 30,5" stroke="#fff" stroke-width="5"/>
						<path d="M0,14 30,14" stroke="#fff" stroke-width="5"/>
						<path d="M0,23 30,23" stroke="#fff" stroke-width="5"/>
					</svg>
					<font style="margin-left:10px;position:absolute;top:22px;">Survey's</font>
				</a>
			</span>

			<ul class="navbar-nav">
				<li><a href="./sing-up/">&#128236;Registro</a></li>
				<!-- <li><a href="#">Username</a></li> -->
			</ul>
			<!-- Encuestado -->
		</nav>

		<div id="main">
			<h2>Inicio de Sesión</h2>
			<?php 
				//Mostrar Alert
				if(isset($is_logged)){
					echo '<div class="alert alert-error">Nombre de Usuario o Contraseña Erronea.</div>';
				}
			?>
			<form action="#" method="post">
				<div class="form">
					
					<label for="user">Usuario:</label>
					<input type="text" autocomplete="off" name="user" id="user" placeholder="Ingrese Nombre de Usuario">

					<label for="pass">Contraseña:</label>
					<input type="password" name="pass" id="pass" placeholder="Ingrese Contraseña">
					

				</div>
				<input type="submit" name="boton" value="Ingresar" class="btn" style="margin-top:1em;">
			</form>
		</div>

		<div class="footer" style="margin-top: 200px;">
			<br><p>Creado por Alexander Arellano & Victor Rivas</p>
		</div>
	</body>
</html>