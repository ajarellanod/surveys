<?php
	
	//Clase Que Mantiene la Conexión
	class DB {
	    protected static $con;
	    public static function start(){
	    	//Conexión
	        self::$con=new mysqli('localhost','root','','survey');
	        //Si Falla se Rompe la Conexión
	        if(!self::$con){echo self::$con->connect_errno; exit;}
	        //Cambia Tipo de Caracter
	        self::$con->set_charset("utf8");
	        //Devuelve la Conexión
	        return self::$con;
	    }
	}
	//Clase Que Mantiene la Conexión

	//Clase Usuario
	class User extends DB {

		public static function register(string $user, string $pass, string $name, string $email){
			//Consultamos por el Usuario
			$result = self::$con->query("SELECT * FROM usuarios WHERE usuario = '$user'");
			
			//Si no existe, se registra
			if($result->num_rows == 0){
				self::$con->query("INSERT INTO `usuarios`(`usuario`, `contraseña`, `nombre`, `email`) 
									VALUES ('$user',MD5('$pass'),'$name','$email')");
				return True;
			}else{
				return False;
			}

		}

		public static function login($user,$pass){
			$result = self::$con->query("SELECT contraseña FROM usuarios WHERE usuario = '$user'");
			if($result){
				$row = $result->fetch_object();
				if($row->contraseña == md5($pass)){
					return True;
				}else{
					return False;
				}
			}
		}
	}
	//Clase Usuario

	//Clase Encuesta
	Class Survey extends DB
	{

		public static function get($code){
			$result = self::$con->query("SELECT * FROM encuestas WHERE id = '$code'");
			if ($result->num_rows == 1){
				$respond = array();
				$preguntas = array();

				$survey = $result->fetch_object();
				$respond['Encuesta'] = $survey->nombre_encuesta;

				$result_questions = self::$con->query("SELECT * FROM preguntas WHERE id_encuesta = '$code'");
				while($questions = $result_questions->fetch_object()){
					$respuestas = array();

					if ($questions->prede == 0) {
						$result_answers = self::$con->query("SELECT * FROM respuestas_c WHERE id_pregunta = '$questions->id'");
						while ($answers = $result_answers->fetch_object()) {
							$respuestas[] = $answers->respuesta;
						}
						$preguntas[] = array('Pregunta' => $questions->pregunta,
									         'Respuestas' => $respuestas);
					}else{
						$preguntas[] = array('Pregunta' => $questions->pregunta,
									         'Respuestas' => False);
					}
				}
				$respond['Preguntas'] = $preguntas;
				//echo json_encode($respond,JSON_UNESCAPED_UNICODE);
				return $respond;
			}else{
				return False;
			}
		}

		public static function get_answers_p(){
			$result = self::$con->query("SELECT * FROM respuestas_p");
			$answers = array();
			while($obj = $result->fetch_object()){
				$answers[] = $obj->respuesta;
			}
			return $answers;
		}

		public static function set_elections($user,$survey,$question,$election){
			//Consultamos por la Eleccion
			$result = self::$con->query("SELECT * FROM `elecciones` WHERE usuario = '$user' AND 
										id_encuesta = '$survey' AND pregunta = '$question'");
			
			//Si no existe, se registra, sino se hace update
			if($result->num_rows == 0){
				self::$con->query("INSERT INTO `elecciones`(`usuario`, `id_encuesta`, `pregunta`, `respuesta`) VALUES ('$user','$survey','$question','$election')");
			}else{
				self::$con->query("UPDATE `elecciones` SET `respuesta`= '$election' WHERE usuario = '$user' AND id_encuesta = '$survey' AND pregunta = '$question'");
			}
		}

		public static function get_election($user,$survey,$question){
			//Consultamos por la Eleccion
			$result = self::$con->query("SELECT * FROM `elecciones` WHERE usuario = '$user' AND 
										id_encuesta = '$survey' AND pregunta = '$question'");
			if($result->num_rows == 1){
				$obj = $result->fetch_object();
				return $obj->respuesta;
			}else{
				return False;
			}
		}

		public static function is_finished($user,$survey){
			$result1 = self::$con->query("SELECT COUNT(*) 'total' FROM `elecciones` 
										 WHERE usuario = '$user' AND id_encuesta = '$survey'");
			$obj1 = $result1->fetch_object();

			$result2 = self::$con->query("SELECT COUNT(*) 'total' FROM `preguntas`
										 WHERE id_encuesta = '$survey'");
			$obj2 = $result2->fetch_object();

			if ($obj1->total == $obj2->total) {
				return True;
			}else{
				return False;
			}
		}

		public static function set_survey($user,$name){
			self::$con->query("INSERT INTO `encuestas`(`creador`, `nombre_encuesta`) VALUES ('$user','$name')");
		}

		public static function set_question_and_answers($question_name,$answers){

			$result = self::$con->query("SELECT MAX(id) AS id FROM `encuestas`");
			$survey = $result->fetch_object();

			if ($answers){
				
				self::$con->query("INSERT INTO `preguntas`(`id_encuesta`, `pregunta`, `prede`) 
									VALUES ('$survey->id','$question_name','0')");

				$result_q = self::$con->query("SELECT MAX(id) AS id FROM `preguntas`");
				$question = $result_q->fetch_object();

				foreach ($answers as $answer) {
					self::$con->query("INSERT INTO `respuestas_c`(`id_pregunta`, `respuesta`) 
										VALUES ('$question->id','$answer')");
				}

				return $survey->id;

			}else{

				self::$con->query("INSERT INTO `preguntas`(`id_encuesta`, `pregunta`, `prede`) 
									VALUES ('$survey->id','$question_name','1')");

				return $survey->id;

			}
		}


		public static function get_stats_answers($survey,$question){
			$list = array();

			$result_total = self::$con->query("SELECT COUNT(*) AS participantes FROM `elecciones` 
												WHERE id_encuesta=$survey and pregunta=$question");
			$total = $result_total->fetch_object();
			$total = $total->participantes;


			$result_total_answers = self::$con->query("SELECT respuesta, COUNT(respuesta) AS total 
										FROM `elecciones` WHERE id_encuesta=$survey and  pregunta=$question 
										GROUP BY pregunta, respuesta ORDER BY pregunta");

			$total_answers = $result_total_answers->fetch_array();

			for ($i=1; $i <= $total ; $i++) { 
				echo "Respuesta " . $total_answers["respuesta"];
			}

		}


	}
	//Clase Encuesta


	DB::start();
?>

