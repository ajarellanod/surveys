<?php
	require_once('./classes/Model.php'); 
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
		    	echo"<script>window.location.href='/survey';</script>";
		        exit();
		    }
		}

		public static function valid_param($route, array $param = array()){
			if(!isset($param[0]) && !isset($param[1])){
				echo"<script>window.location.href='/survey/index';</script>";
			}elseif (isset($param[0]) && !isset($param[1])) {
				echo"<script>window.location.href='/survey/$route/$param[0]/1';</script>";
			}
		}

	}
?>