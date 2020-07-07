<?php
	//Deja de Reportar Errores
	error_reporting(0);

	//Rutas
	require_once('routes.php');

	//Configuración Necesaria: Ejecuta todas las funciones automaticamente
	function __autoload($class_name){

		if(file_exists('./classes/'.$class_name.'.php')){

			require_once './classes/'.$class_name.'.php';

		} elseif (file_exists('./controllers/'.$class_name.'.php')){

			require_once './controllers/'.$class_name.'.php';
			
		}
		
	}
?>