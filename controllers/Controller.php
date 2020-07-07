<?php 
	/**
	 * 
	 */
	class Controller
	{
		public static function render($view_name, array $vars = array()) {
		  	ob_start();
			  	extract($vars);
			  	include "./views/$view_name.php";
		  	return ob_end_flush();
		}

		public static function is_logged(){
			session_start();
		    if (!isset($_SESSION['logged'])) {
		        header('Location: /survey');
		        exit();
		    }
		}

		public static function valid_param($route, array $param = array()){
			if(!isset($param[0]) && !isset($param[1])){
				header("Location: /survey/index");
			}elseif (isset($param[0]) && !isset($param[1])) {
				header("Location: /survey/$route/$param[0]/1");
			}
		}
	}
?>