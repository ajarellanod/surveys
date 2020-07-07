<?php
	require_once('./classes/Model.php');
	/**
	 * 
	 */
	class IndexController extends Controller
	{

		public static function get(){
			self::is_logged();
			self::render('index');
		}

		public static function post(array $data = array())
		{	
			self::is_logged();

			if (isset($data["code"])) {
				$code = $data["code"];
				header("Location: /survey/survey/$code/1");
				exit();
			}

			if (isset($data["name"]) && isset($data["number"])) {
				if ($data["number"] < 16 && $data["number"] >= 3) {

					$name = $data["name"];
					$user = $_SESSION['logged'];

					Survey::set_survey($user,$name);

					self::render('index', array('times' => $data["number"]));
					exit();
				}else{
					echo "<script type='text/javascript'>
					        alert('Tienes un Minimo de 3 Preguntas y un Maximo de 15');
					        location = '/survey/index';
					      </script>";
				}
			}

			for ($i=1; $i <= $data["times"]; $i++) { 
				$question = $data["question$i"];
				$answers_c = array(); 
				if (!empty($data["answer1$i"]) && !empty($data["answer2$i"]) && !empty($data["answer3$i"])) {
					for ($j=1; $j <= 5  ; $j++){
						if (!empty($data["answer$j$i"])) {
							$answers_c[] = $data["answer$j$i"];
						}
					}
				}else{
					$answers_c = False;
				}

				$id = Survey::set_question_and_answers($question,$answers_c);

				echo "<script type='text/javascript'>
					        alert('El Codigo de Su Encuesta Es -> $id , Uselo para Ingresar');
					        location = '/survey/index';
					  </script>";
			}

		}

	};
?>