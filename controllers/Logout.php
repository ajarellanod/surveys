<?php

	class Logout
	{
		public static function get(){
			//Crear sesión
		    session_start();
		    //Vaciar sesión
		    $_SESSION = array();
		    //Destruir Sesión
		    session_destroy();
		    //Redireccionar a login.php
		    header("location: /survey");
		}
	}
?>