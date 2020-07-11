<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<title>Creación de Encuesta</title>
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
				<li><a href="/survey/history">&#128196;Resultados de Encuestas Creadas</a></li>
				<li><a href="#" title="Usuario en Sesión">&#128102;<?php echo $_SESSION['logged']; ?></a></li>
			</ul>
			<!-- Encuestado -->
		</nav>

		<!-- The Modal -->
		<div id="myModal" class="modal">
		  <!-- Modal content -->
		  <div class="modal-content">
		    <span class="close">&times;</span>
		    <h2>Inicio de Encuesta</h2>
			<form action="/survey/index" method="post">
				<div class="form">
					
					<label for="code">Codigo de Encuesta:</label>
					<input type="text" autocomplete="off" name="code" id="code" placeholder="Ingrese Codigo de Encuesta">
					<br><br>
				</div>
				<input type="submit" name="boton" value="&#128209;Realizar Encuesta" class="btn" style="margin-top:1em;">
			</form>
		  </div>
		</div>

		<!-- The Modal -->
		<div id="myModal2" class="modal">
		  <!-- Modal content -->
		  <div class="modal-content">
		    <span id="close2" class="close">&times;</span>
		    <h2>Creación de Encuesta</h2>
			<form action="/survey/index" method="post">
				<div class="form">
					
					<label for="name">Nombre de la Encuesta:</label>
					<input type="text" autocomplete="off" required name="name" id="name" placeholder="Ingrese Nombre de la Encuesta">

					<label for="number">Numero de Preguntas:</label>
					<input type="text" autocomplete="off" required name="number" id="number" placeholder="Numero de Preguntas">

					<br><br>
				</div>
				<input type="submit" name="boton" value="Crear Encuesta" class="btn" style="margin-top:1em;">
			</form>
		  </div>
		</div>

		<?php 
			if (isset($times)) {

				echo "
					<div class='main'>
							<h2>&#128221;Creación de Encuesta</h2>
							<br><hr>

							<form action='#' method='post'>
				";

				for ($i=1; $i <= $times; $i++) {

						echo "

								<div class='form' style='margin-top: 20px;'>

									<label for='question$i' style='font-size: 15px;'>Pregunta #$i:</label>

									<input type='text' required autocomplete='off' name='question$i' id='question$i' placeholder='Ingrese Su Pregunta'>

									<label style='position: relative;font-size: 15px;'>
										Respuestas Personalizadas
										<input id='myCheck$i' type='checkbox' 
										data-step='$i' onclick='myFunction(this)'>
									</label> 


									<div id='answers$i' class='answers' data-step='$i'
									 style='display: none; margin-top: 5px;'>

										<label for='answser1' style='font-size: 15px;'>Respuesta #1:</label>
										<input type='text' name='answer1$i' style='width:75%; margin-top:14px' id='answser1' placeholder='Ingrese Respuesta'>

										<label for='answer2' style='font-size: 15px;'>Respuesta #2:</label>
										<input type='text' name='answer2$i' style='width:75%; margin-top:14px' id='answer2' placeholder='Ingrese Respuesta'>

										<label for='answer3' style='font-size: 15px;'>Respuesta #3:</label>
										<input type='text' name='answer3$i' style='width:75%; margin-top:14px' id='answer3' placeholder='Ingrese Respuesta'>

										<label for='answer4' style='font-size: 15px;'>Respuesta #4:</label>
										<input type='text' name='answer4$i' style='width:75%; margin-top:14px' id='answer4' placeholder='Ingrese Respuesta'>

										<label for='answer5' style='font-size: 15px;'>Respuesta #5:</label>
										<input type='text' name='answer5$i' style='width:75%; margin-top:14px' id='answer5' placeholder='Ingrese Respuesta'>

									</div>

								</div>
						";
				}

				echo "
							<input type='text' name='times' value='$times' style='display: none;'>
							<input type='submit' name='boton' value='Guardar Encuesta' class='btn' style='margin-top:1em;'>
							</form>

							<br>
						</div>
				";
			}
		?>

		<div id="main">
			<h2>Bienvenido a Survey's</h2>
			<?php 
				//Mostrar Alert
				if(isset($id)){
					echo "<div class='alert alert-info'>El Codigo de su Encuesta es $id - Tambien Puede 
						<a href='/survey/survey/$id/1'>Ingresar Acá.</a> </div>";
				}
			?>
			<br><hr>
			<div style="margin:2em auto;width:75%;">
				<a href="#" id="myBtn2" class="btn" style="padding:2em;">&#128221;Crear Encuesta</a>
				<a id="myBtn" href="#" class="btn" style="padding:2em; margin-top:1em">&#128209;Realizar Encuesta</a>
			</div>
			<br>
		</div>

		<div class="footer" style="margin-top:230px;">
			<br><p>Made with &#129505;</p>
		</div>

		<script type="text/javascript">

			function myFunction(e) {
			  const step = e.dataset.step;
			  const steps = document.getElementsByClassName('answers');

			  console.log(step);
			  console.log(steps);

			    if (e.checked == true) {
			      steps[step - 1].style.display = "block";
			    } else {
			      steps[step - 1].style.display = "none";
			    }
			}

			function showAnswers(me){

			  	var check = document.getElementById("myCheck1");
				var answers = document.getElementById("answers1");

			  	// If the checkbox is checked, display 
			  	if (check.checked == true){
			    	answers.style.display = "block";
			  	} else {
			    	answers.style.display = "none";
			  	}
			}

			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("myBtn");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			var modal2 = document.getElementById("myModal2");

			// Get the button that opens the modal
			var btn2 = document.getElementById("myBtn2");

			// Get the <span> element that closes the modal
			var span2 = document.getElementById("close2");

			// When the user clicks on the button, open the modal
			btn.onclick = function() {
			  modal.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			  modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			  if (event.target == modal) {
			    modal.style.display = "none";
			  }
			}

			// When the user clicks on the button, open the modal
			btn2.onclick = function() {
			  modal2.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span2.onclick = function() {
			  modal2.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			  if (event.target == modal) {
			    modal2.style.display = "none";
			  }
			}
		</script>
	</body>
</html>