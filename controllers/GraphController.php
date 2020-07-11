<?php
	require_once('./classes/Model.php');
	/**
	 * 
	 */
	class GraphController extends Controller
	{

		public static $list = array();

		public static function get(array $param = array()){
			//Validaciones y Redirecciones en la URL
			self::is_logged();
			self::valid_param('graph',$param);

			$survey = Survey::get($param[0]);

			if($survey){

				$bool = Survey::get_survey_creator($param[0],$_SESSION['logged']);
				if(!$bool){
					echo "<script type='text/javascript'>
					        alert('No Eres el Creador de esta Encuesta');
					        location = '/survey/index';
					      </script>";
					exit();
				}

				self::$list["survey"] = $survey['Encuesta'];

				self::$list["questions"] = $survey['Preguntas'];

				self::$list["actual_question"] = $survey['Preguntas'][$param[1]-1]['Pregunta'];

				self::$list["actual_question_id"] = $param[1];

				$answers_p = Survey::get_answers_p();

				if ($survey['Preguntas'][$param[1]-1]['Respuestas']){

					self::$list["answers"] = $survey['Preguntas'][$param[1]-1]['Respuestas'];

					$total = count($survey['Preguntas'][$param[1]-1]['Respuestas']);

					self::$list["percentage"] = Survey::get_stats_answers($param[0],$param[1],$total);

				}else{
					self::$list["answers"] = $answers_p;
					self::$list["percentage"] = Survey::get_stats_answers($param[0],$param[1],5);
				}

				self::render('graph', self::$list);

			}else{
				echo "<script type='text/javascript'>
				        alert('¡La Encuesta No Existe!');
				        location = '/survey/index';
				      </script>";
			}

			//self::render('about');
		}

		public static function post(array $data = array(), array $param = array()){
			self::is_logged();
			self::valid_param('graph',$param);

			$boton = $data["boton"];
			$survey = $param[0];

			if ($boton == "Siguiente") {
				$next_question = $param[1] + 1;
				echo"<script>window.location.href='/survey/graph/$survey/$next_question';</script>";
			}else{
				echo"<script>window.location.href='/survey/index';</script>";
			}
		}
	}
?>