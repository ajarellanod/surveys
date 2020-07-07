<?php
	require_once('./classes/Model.php');
	/**
	 * 
	 */
	class SurveyController extends Controller
	{

		public static $list = array(); 

		public static function get(array $param = array()){
			//Validaciones y Redirecciones en la URL
			self::is_logged();
			self::valid_param('survey',$param);
			
			$survey = Survey::get($param[0]);

			if($survey){

				if ($param[1] <= count($survey['Preguntas'])) {

					self::$list["survey"] = $survey['Encuesta'];
					self::$list["questions"] = $survey['Preguntas'];
					$answers_p = Survey::get_answers_p();
					self::$list["actual_question"] = $survey['Preguntas'][$param[1]-1]['Pregunta'];
					self::$list["actual_question_id"] = $param[1];
					self::$list["with_election"] = Survey::get_election($_SESSION['logged'],
																			 $param[0],
																			 $param[1]);

					if ($survey['Preguntas'][$param[1]-1]['Respuestas']){
						self::$list["answers"] = $survey['Preguntas'][$param[1]-1]['Respuestas'];
					}else{
						self::$list["answers"] = $answers_p;
					}
					
					self::render('base', self::$list);

				}else{
					echo "<script type='text/javascript'>
					        alert('¡La Pregunta No Existe!');
					        location = '/survey/survey/$param[0]/1';
					      </script>";
				}
				
			}else{
				echo "<script type='text/javascript'>
				        alert('¡La Encuesta No Existe!');
				        location = '/survey/index';
				      </script>";
			}
		}

		public static function post(array $data = array(), array $param = array()){

			self::is_logged();
			self::valid_param('survey',$param);

			$user = $_SESSION['logged'];
			$survey = $param[0];
			$question = $param[1];
			$boton = $data["boton"];

			if ($data["answer"] > 0 && $data["answer"] < 6 ) {

				$election = $data["answer"];

				if ($boton == "Siguiente") {

					Survey::set_elections($user,$survey,$question,$election);
					$next_question = $param[1] + 1;
					header("Location: /survey/survey/$survey/$next_question");
				}else{

					Survey::set_elections($user,$survey,$question,$election);
					$is_finished = Survey::is_finished($user,$survey);

					if ($is_finished) {
						echo "<script type='text/javascript'>
						        alert('¡Gracias por Finalizar la Encuesta!');
						        location = '/survey/index';
						      </script>";
					}else{
						echo "<script type='text/javascript'>
						        alert('No Ha Respondido Todas las Preguntas');
						        location = '/survey/survey/$survey/1';
						      </script>";
					}

				}
			}else{
				echo "<script type='text/javascript'>
					        alert('Seleccione Alguna Respuesta!');
					        location = '/survey/survey/$survey/$question';
					  </script>";
				exit();
			}

		}
	}
?>