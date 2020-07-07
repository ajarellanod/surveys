<?php 
	
	class Route
	{
		//Rutas y Parametros Validos
		public static $get_routes = array();
		public static $post_routes = array();
		public static $params = array('<int>');

		public static function add($url, $controller, $method)
		{
			if($method == 'GET'){
				self::$get_routes[$url] = $controller;
			}elseif ($method == 'POST'){
				self::$post_routes[$url] = $controller;
			}
		}
		
		public static function run_controller($controller_name, $method, $data = array(), $param = array())
		{
			if (file_exists('./controllers/'.$controller_name.'.php')){

				require_once './controllers/'.$controller_name.'.php';

				if($method == 'GET'){
					$controller_name::get($param);
				}elseif ($method == 'POST'){
					$controller_name::post($data, $param);	
				}else{
					$controller_name::run($data, $param);
				}

			}else{
				echo "Error 203: No Existe Controlador";
			}
		}

		public static function run($uri, $method)
		{
			//Volvemos un Array la URL y definimos la ruta
			$url = explode("/", $uri);
			$url = array_slice($url, 1);
			$route = $url[1];
			$param[] = $url[2];
			$param[] = $url[3];
			
			//Definimos en que rutas buscar dependiendo del metodo
			if($method == 'GET'){
				$routes = self::$get_routes;
			}elseif ($method == 'POST'){
				$routes = self::$post_routes;
				$data = $_POST;
			}

			if(array_key_exists($route, $routes)){
				//Extraemos Controlador y lo corremos
				$controller = $routes[$route];
				self::run_controller($controller,$method,$data,$param);
			}else{
				echo "Error 404";
			}
		}

	}

?>