<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>Resultados de Encuesta</title>
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
					<font style="margin-left:10px;position:absolute;top:22px;">&#128218;Menú de Preguntas</font>
				</a>
			</span>

			<ul class="navbar-nav">
				<li><a href="/survey/logout/">&#128075;Cerrar Sesión</a></li>
				<li><a href="/survey/index" >🏠Inicio</a></li>
				<li><a href="#" title="Usuario en Sesión">&#128102;<?php echo $_SESSION['logged']; ?></a></li>
				<center><li><a href="#" title="Nombre de Encuesta">&#128209;<?php echo $survey; ?></a></li></center>
			</ul>
			<!-- Encuestado -->
		</nav>

		<div id="side-menu" class="side-nav">
			<a href="#" class="btn-close" onclick="closeSideMenu()">&times;</a>
			<a href="#" class="title"><font style="color:#fff;cursor:default;">Preguntas</font></a>
			<?php
				if (isset($questions)){
					$cont_questions = 0;
					foreach ($questions as $question) {
						$cont_questions = $cont_questions + 1;
			 	 		echo "<a href='./$cont_questions'>".$question["Pregunta"]."</a>";
			 		}
				}
			?>
		</div>

		<div id="main">
			<?php 
				if (isset($actual_question)) {
					echo "<h2>$actual_question</h2>";
				}
			?>
			<br><hr>
			<form action="#" method="post">
				<div class="radio">
					<?php
						if (isset($answers)){
							$cont_answers = 0;
							foreach ($answers as $answer) {
								$cont_answers = $cont_answers + 1;
								$show = $percentage[$cont_answers];
								$width = ($show/2) + 40;
								
									echo "
										<div class='myProgress'>
										   	<div class='myBar' style='width:$width%'>$answer</div>
										   	<p style='display:inline-block;margin-bottom=5px;'>
										   		$show%
										   	</p>
										</div>
									";
	
					 		}
						}
					?>
				</div>
				<?php
					if (isset($questions)){
						if (count($questions) == $actual_question_id){
							echo '<input type="submit" name="boton" value="Salir de Encuesta" class="btn">';
						}else{
							echo '<input type="submit" name="boton" value="Siguiente" class="btn">';
						}
					}
				?>
			</form>
		</div>

		<div class="footer" style="margin-top:230px;">
			<br><p>Made with &#129505;</p>
		</div>

		<script type="text/javascript">
			function openSideMenu(){
				document.getElementById('side-menu').style.width = '250px';
			}

			function closeSideMenu(){
				document.getElementById('side-menu').style.width = '0px';
			}
		</script>
	</body>
</html>

