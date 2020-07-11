<?php 
	require_once('./classes/Model.php');
	/**
	 * 
	 */
	class HistoryController extends Controller
	{

		public static function get(array $param = array())
		{
			self::is_logged();

			$surveys = Survey::get_surveys_created($_SESSION['logged']);

			if ($surveys) {
				self::render('history', array("surveys" => $surveys));
			}else{
				echo "<script type='text/javascript'>
					        alert('Aun No Has Creado Ninguna Encuesta!');
					        location = '/survey/index';
					      </script>";
			}

		}

		public static function post(array $data = array())
		{
			
		}

	}
?>