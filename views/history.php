<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>Encuestas Creadas</title>
		<link rel="stylesheet" href="/survey/views/static/css/style.css">
	</head>
	<body>
		<nav class="navbar">
			<!-- Encuestado -->
			<span class="slide">
				<a href="#" id="icono">
					<video width="40" height="40" autoplay>
					    <source src="/survey/views/media/Ujap.mov" type="video/mp4">
					</video>
					<font style="margin-left:10px;position:absolute;top:22px;">Survey's</font>
				</a>
			</span>

			<ul class="navbar-nav">
				<li><a href="/survey/logout/">&#128075;Cerrar Sesión</a></li>
				<li><a href="/survey/index" >🏠Inicio</a></li>
				<li><a href="#" title="Usuario en Sesión">&#128102;<?php echo $_SESSION['logged']; ?></a></li>
			</ul>
			<!-- Encuestado -->
		</nav>

		<div id="main">
			<h2>&#128196;Encuestas Creadas</h2>
			<br><hr><br>
			<?php 
				//Mostrar Alert
				if(isset($is_logged)){
					echo '<div class="alert alert-error">Nombre de Usuario o Contraseña Erronea.</div>';
				}
			?>
			<table>
				<tr>
					<th>Nombre de Encuesta</th>
					<th>Graficas📊</th>
					<th>Codigo</th>
				</tr>
				<?php 
					//Mostrar Alert
					if(isset($surveys)){
						foreach ($surveys as $id => $name) {
							echo "
								<tr>
									<td>$name</td>
									<td><a href='/survey/graph/$id/1'>Ver Acá</a></td>
									<td>$id</td>
								</tr>
							";
						}
					}
				?>
				
				
			</table>
			<br><br>
		</div>

		<div class="footer" style="margin-top: 250px;">
			<br><p>Made with &#129505;</p>
		</div>
	</body>
</html>