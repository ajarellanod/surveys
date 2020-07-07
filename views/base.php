<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>Encuesta</title>
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
			<form action="#" method="post" class="formulario">
				<div class="radio">
					<?php
						if (isset($answers)){
							$cont_answers = 0;
							foreach ($answers as $answer) {
								$cont_answers = $cont_answers + 1;
								if($with_election == $cont_answers){
									echo '<input type="radio" checked name="answer" value="'.$cont_answers.'" id="x'.$cont_answers.'">';
								}else{
									echo '<input type="radio" name="answer" value="'.$cont_answers.'" id="x'.$cont_answers.'">';
								}
					 	 		echo '<label for="x'.$cont_answers.'">'.$answer.'</label>';
					 		}
						}
					?>
				</div>
				<?php
					if (isset($questions)){
						if (count($questions) == $actual_question_id){
							echo '<input type="submit" name="boton" value="Terminar Encuesta" class="btn">';
						}else{
							echo '<input type="submit" name="boton" value="Siguiente" class="btn">';
						}
					}
				?>
			</form>
		</div>

		<div class="footer">
			<br><p>Creado por Alexander Arellano & Victor Rivas</p>
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

